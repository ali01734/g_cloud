<?php

namespace nataalam\Http\Controllers;

use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Input;
use nataalam\Models\Branch;
use nataalam\Models\Course;
use nataalam\Http\Requests\StoreSubjectRequest;
use nataalam\Http\Requests\UpdateSubjectRequest;
use nataalam\Models\Level;
use nataalam\Models\Subject;


class SubjectController extends Controller
{
    public function adminIndex()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function createInAdmin()
    {
        $icons = self::iconsPaths();

        return view('admin.subjects.create', compact('icons'));
    }

    /**
     * Finds the paths of the subjects' icons
     * @return array list of url of the icons
     */
    private static function iconsPaths()
    {
        $publicPath = preg_quote(public_path());
        $fileInfoToUrl = function ($i) use ($publicPath) {
            $path = $i->getRealPath();
            return preg_replace("#^$publicPath#", '', $path);
        };

        $iconsInfo = File::allFiles(public_path("images/subjects/"));
        return array_map($fileInfoToUrl, $iconsInfo);
    }

    public function getCourses($subject, $input)
    {
        $query = $subject->courses();

        if (!empty($input['level']))
            $query->where('level_id', $input['level']);

        if (!empty($input['branch'])) {
            $query->whereHas('branches', function ($q) use ($input) {
                $q->where('id', $input['branch']);
            });
        }

        $perPage = !empty($input['per_page']) ? $input['per_page'] : 10;
        return $query->paginate($perPage);
    }

    public function showInAdmin(Subject $subject)
    {
        $input = Input::all();
        $levels = Level::all();
        $branches = Branch::all();
        $courses = $this->getCourses($subject, $input);

        $perPage = !empty($input['per_page']) ? $input['per_page'] : 10 ;
        $selectedLevel = !empty($input['level']) ? $input['level'] : null;
        $selectedBranch = !empty($input['branch']) ? $input['branch'] : null;

        return view(
            'admin.subjects.show',
            compact(
                'perPage',
                'subject',
                'courses',
                'levels',
                'branches',
                'selectedLevel',
                'selectedBranch'
            )
        );
    }

    public function editInAdmin($id)
    {
        $subject = Subject::findOrFail($id);
        $icons = self::iconsPaths();

        return view('admin.subjects.edit', compact('icons', 'subject'));
    }

    public function frontendIndex()
    {
        return view(
            'client.course-board.subjects',  [
                'subjects' => Subject::all(),
                'levels' => Level::all()
            ]
        );
    }

    public function showInFrontend(Subject $subject)
    {
        $levels = Level::all();

        $userHasLevelAndBranch = Auth::user()
            && Auth::user()->level
            && Auth::user()->branch;

        return view(
            'client.subjects.show',
            compact(
                'subject',
                'levels',
                'userHasLevelAndBranch'
            )
        );
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return back();
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = new Subject($request->all());
        $subject->save();

        return Redirect::route($request->get('redirect-to'));
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        $subject->save();

        return Redirect::route($request->get('redirect-to'));
    }
}
