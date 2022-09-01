<?php

namespace nataalam\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Log;
use nataalam\Http\Requests;
use nataalam\Http\Requests\StoreBacRequest;
use nataalam\Http\Requests\UpdateBacRequest;
use nataalam\Models\BacExamFile;
use nataalam\Models\Branch;
use nataalam\Models\Subject;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BacController extends Controller
{
    /**
     * @param StoreBacRequest $request
     * @param $bac
     */
    private static function moveUploadedBacFiles(StoreBacRequest $request, $bac)
    {
        $filename = "$bac->id.pdf";
        if ($request->exists('exam')) {
            $request
                ->file('exam')
                ->move(storage_path(BacExamFile::$bacDir), $filename);

            Log::info('Moved bac exam file', ['filename' => $filename]);
        }


        if ($request->exists('correction')) {
            $request
                ->file('correction')
                ->move(storage_path(BacExamFile::$correctDir), $filename);

            Log::info(
                'Moved bac correction file',
                ['filename' => $filename]
            );
        }
    }

    private function getAcademicYears()
    {
        return array_reverse(range(1990, date('Y')));
    }

    public function indexInAdmin(Subject $subject)
    {
        return view(
            'admin.bacs.index', [
                'bacs' => $subject->bacs()->paginate(10),
                'subject' => $subject,
                'types' => BacExamFile::$types
            ]
        );
    }

    private function getRegions() {
        $regions = [];
        foreach(range(1, 12) as $key => $value)
            $regions[$key + 1] = "region$value";

        return $regions;
    }

    public function edit(BacExamFile $bac) {
        return view(
            'admin.bacs.edit', [
                'bac' => $bac,
                'subject' => $bac->subject,
                'years' => $this->getAcademicYears(),
                'curBranches' => $bac->branches,
                'regions' => $this->getRegions()
            ]
        );
    }

    public function update(BacExamFile $bac, UpdateBacRequest $req) {
        $bac->update($req->all());
        $bac->region = 2;
        $bac->save();

        $bac->branches()->sync($req->get('branches'));

        Session::flash('success', 'updateSuccess' . ' ' . $req->get('region'));
        return redirect()->route('admin.bacs.index', $bac->subject);
    }

    /**
     * Show create form
     * @param Subject $subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createInAdmin(Subject $subject)
    {
        return view(
            'admin.bacs.create', [
                'subject' => $subject,
                'years' => $this->getAcademicYears(),
                'branches' => Branch::all(),
                'regions' => $this->getRegions()
            ]
        );
    }

    public function apiIndex(Subject $subject,
                             Request $req,
                             $type = null)
    {
        $selectedBranch = $req->get('branch');
        $selectedRegion = $req->get('region');

        $bacs = BacExamFile::filter(
            $subject, $type, $selectedBranch, $selectedRegion
        );

        return $bacs;
    }

    public function indexInFrontend(Subject $subject,
                                    Request $req,
                                    $type = null
    ) {
        $bacs = $this->apiIndex($subject, $req, $type);

        $selectedBranch = $req->get('branch');
        $selectedRegion = $req->get('region');
        $year = $req->route('type') == 'regional' ? 'first' : 'second';

        $regions = BacExamFile::regionsWithExams($subject, $type);

        $branches = DB::table('branches')
            ->leftJoin('bac_exam_file_branch', 'branches.id', '=', 'bac_exam_file_branch.branch_id')
            ->leftJoin('bac_exam_files', 'bac_exam_files.id', '=', 'bac_exam_file_branch.bac_exam_file_id')
            ->where("branches.${year}_year", '=', true)
            ->groupBy('branches.id')
            ->select('branches.id', 'branches.name', DB::raw('COUNT(bac_exam_file_id) as count'), 'first_year', 'second_year')
            ->get();

        //dd($branches);
        $comments = $subject->commentsForYear($year)
            ->with('replies')
            ->orderBy('created_at', 'desc')
            ->notReply()
            ->paginate(10);

        $postUrl = route('subjects.comments.store', $subject->id);
        $replyUrl = function ($params) {
            return route('replies.store', $params);
        };

        return view(
            'client.bacs.index',
            compact(
                'regions',
                'subject',
                'comments',
                'postUrl',
                'replyUrl',
                'bacs',
                'branches',
                'type',
                'selectedBranch',
                'selectedRegion'
            )
        );
    }

    public function store(Subject $subject, StoreBacRequest $req)
    {
        try {
            DB::beginTransaction();

            $bac = $subject->bacs()->create($req->all());
            $bac->branches()->sync($req->get('branches'));

            self::moveUploadedBacFiles($req, $bac);
            return self::storeSuccess($subject, $bac->id);

        } catch (FileException $e) {
            return self::storeFailure();
        }
    }

    private static function storeSuccess(Subject $subject, $bacId)
    {
        DB::commit();
        Session::flash('success', 'bacSuccess');
        Log::info('Successfully added a BacExamFile', ['id' => $bacId]);

        return redirect(route('admin.bacs.index', $subject));
    }

    private static function storeFailure()
    {
        DB::rollBack();
        Session::flash('error', 'bacError');
        return redirect()->back();
    }

    public function destroy(BacExamFile $bac)
    {
        $bac->delete();
        return redirect()->back();
    }
}
