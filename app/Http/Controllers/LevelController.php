<?php

namespace nataalam\Http\Controllers;

use DB;
use nataalam\Models\Branch;
use nataalam\Http\Requests;
use nataalam\Http\Requests\AddBranchToLevelRequest;
use nataalam\Http\Requests\StoreLevelRequest;
use nataalam\Models\Level;


class LevelController extends Controller
{
    /**
     * Show a single level in the admin UI
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInAdmin($id)
    {
        $level = Level::findOrFail($id);
        $subject = $level->subject;
        return view('levels.show', compact('level', 'subject'));
    }

    public function store(StoreLevelRequest $request)
    {
        $level = new Level($request->all());
        $level->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return redirect()->back();
    }

    public function update($id, StoreLevelRequest $request)
    {
        $level = Level::findOrFail($id);
        $level->update($request->all());
        return redirect()->back();
    }


    /**
     * Show all level in the admin UI
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $levels = Level::all();
        $branchesObjects = Branch::all();

        $branchesLeft = [];

        foreach ($levels as $level) {
            $branchesLeft[$level->id] = DB::table('branches')
                ->select('id', 'name')
                ->whereNotIn('id', function($query) use($level) {
                    $query
                        ->select(DB::raw('DISTINCT branch_id'))
                        ->from('branch_level')
                        ->where('level_id', '=', $level->id);
                })
                ->get();
        }

        $branches = [];
        foreach($branchesObjects as $br) {
            $branches[$br->id] = $br->name;
        }

        $templateVars = compact('levels', 'branches', 'branchesLeft');
        return view('admin.levels.index', $templateVars);
    }


    /**
     * Add a branch to a level
     *
     * @param AddBranchToLevelRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addBranch(AddBranchToLevelRequest $request, $id)
    {
        $level = Level::findOrFail($id);
        $branch = Branch::findOrFail($request->branch);
        $level->branches()->save($branch);

        return back();
    }

    public function removeBranch($levelId, $branchId)
    {
        $level = Level::findOrFail($levelId);
        $branch = Branch::findOrFail($branchId);

        $level->branches()->detach($branch);

        return back();
    }

    public function getBranches($id)
    {
        $branches = Branch::whereHas('levels', function($q) use ($id) {
            $q->where('id', '=', $id);
        })->get();

        return $branches;
    }

}
