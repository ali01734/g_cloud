<?php

namespace nataalam\Http\Controllers;

use Illuminate\Http\Request;
use nataalam\Http\Requests;
use nataalam\Http\Requests\StoreBranchRequest;
use nataalam\Models\Branch;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class BranchController extends Controller
{
    public function indexInAdmin()
    {
        $branches = Branch::all();
        return view('admin.branches.index', compact('branches'));
    }

    public function store(StoreBranchRequest $request)
    {
        $branch = new Branch($request->all());
        $branch->save();
        $request->session()->flash('success', 'branchStoreSuccess');
        return redirect()->back();
    }

    public function destroy(Branch $branch, Request $request)
    {
        $branch->delete();
        $request->session()->flash('success', 'branchDeleteSuccess');
        return redirect()->back();
    }

    public function showInFrontend($subjectId, $levelId, $branchId)
    {
        $subject = Subject::findOrFail($subjectId);
        $level = Level::findOrFail($levelId);
        $branch = Branch::findOrFail($branchId);

        $courses = Subject
            ::findOrFail($subjectId)
            ->courses()
            ->where('level_id', $levelId)
            ->whereHas('branches', function($q) use($branchId) {
                $q->where('id', $branchId);
            })
            ->get();

        return view('client.branches.show', compact(
            'courses',
            'branch',
            'subject',
            'level'
        ));
    }

    public function showBranchesTypeForm() {
        return view('admin.branches.bac', [
            'branches' => Branch::all()
        ]);
    }

    public function update(Branch $branch, StoreBranchRequest $request) {
        $branch->update($request->all());
        return redirect()->back();
    }
}
