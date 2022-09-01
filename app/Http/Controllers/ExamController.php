<?php

namespace nataalam\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;

use nataalam\Http\Requests\UpdateExamFileRequest;
use nataalam\Models\Branch;
use nataalam\Models\Course;
use nataalam\Models\ExamFile;
use nataalam\Http\Requests;
use nataalam\Http\Controllers\Controller;
use nataalam\Http\Requests\StoreExamRequest;
use nataalam\Models\Subject;
use Session;
use Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ExamController extends Controller
{
    public function adminIndex($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $exams = $subject->exams()->with('courses')->paginate(10);

        return view(
            'admin.exams.index',
            compact('exams', 'subject')
        );
    }

    public function destroy($id, Request $req)
    {
        if (Storage::delete("public/exams/$id.pdf")) {
            $exam = ExamFile::findOrFail($id);
            $exam->delete();
        } else {
            $req
                ->session()
                ->flash('error', 'unableToRemoveFile');
        }

        $req
            ->session()
            ->flash('success', 'theFileWasRemoved');
        return redirect()->back();
    }

    public function indexInFrontend(Course $course, Request $req)
    {
        $selectedBranch = $req->get('branch');
        $exams = $course->exams()->inBranch($selectedBranch)->paginate(10);
        $branches = $course->branches;

        return view(
            'client.exams.index',
            compact('exams', 'course', 'branches', 'selectedBranch')
        );
    }

    public function apiIndex(Course $course, Request $req)
    {
        $selectedBranch = $req->get('branch');
        $exams = $course->exams()->inBranch($selectedBranch)->paginate(10);
        return $exams;
    }

    public function editInAdmin($id)
    {
        $exam = ExamFile::findOrFail($id);
        $courses = $exam->subject->courses;
        $hasCorrection = File::exists(
            storage_path(ExamFile::$correctPath . "/$id.pdf")
        );
        $branches = Branch::all();

        return view(
            'admin.exams.edit',
            compact('exam', 'courses', 'hasCorrection', 'branches')
        );
    }

    /**
     * @param ExamFile $exam
     * @param UpdateExamFileRequest $request
     */
    public function updateFile(ExamFile $exam, UpdateExamFileRequest $request, $keepField, $fileField, $path)
    {
        $filename = "$exam->id.pdf";
        if (!$request->get($keepField))
            if ($request->hasFile($fileField))
                $request->file($fileField)->move(storage_path('app/' . $path), $filename);
            else
                Storage::disk('local')->delete($path . '/' . $filename);
        else if ($request->hasFile($fileField))
            $request->file($fileField)->move(storage_path('app/' . $path), $filename);
    }

    public function update(ExamFile $exam, UpdateExamFileRequest $request)
    {
        $exam->courses()->sync($request->get('courses'));
        $exam->branches()->sync($request->get('branches'));

        $this->updateFile($exam, $request, 'keep_exam', 'exam', ExamFile::$examPath2);
        $this->updateFile($exam, $request, 'keep_correction', 'correction', ExamFile::$correctPath2);

        $request->session()->flash('success', 'editSuccess');

        return redirect()->route('admin.exams.index', $exam->subject->id);
    }

    public function createInAdmin($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $courses = $subject->courses;
        $branches = Branch::all();

        return view(
            'admin.exams.create',
            compact('subject', 'courses', 'branches')
        );
    }

    public function store($subjectId, StoreExamRequest $request)
    {
        $subject = Subject::findOrFail($subjectId);

        try {
            DB::beginTransaction();
            $exam = new ExamFile($request->all());
            $subject->exams()->save($exam);
            $exam->courses()->sync($request->get('courses'));
            $exam->branches()->sync($request->get('branches'));
            $exam->save();

            $filename = "$exam->id.pdf";
            $request
                ->file('exam')
                ->move(storage_path(ExamFile::$examPath), $filename);

            if ($request->exists('correction'))
                $request
                    ->file('correction')
                    ->move(storage_path(ExamFile::$correctPath), $filename);

            DB::commit();
            Session::flash('success', 'theExamWasAdded');
            return redirect()->route('admin.exams.index', $subjectId);

        } catch (FileException $e) {
            DB::rollBack();
            Session::flash('error', 'unableToSaveFile');
            return redirect()->back();
        }
    }
}
