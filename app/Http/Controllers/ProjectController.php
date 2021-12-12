<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects', ['projects' => Project::all()]);
    }

    public function show($id)
    {
        return view('project', ['project' => Project::find($id)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'new_project' => 'required|max:32'
        ]);

        $newProj = new Project();
        $newProj->title = $request['new_project'];
        if ($newProj->title === NULL) {
            return redirect('/projects')->with('status_error', 'Project creation failed.');
        }
        return ($newProj->save() == 1)
            ? redirect('/projects')->with('status_success', 'Project added successfully!')
            : redirect('/projects')->with('status_error', 'Project addition failed.');
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('/projects')->with('status_success', 'Project deleted!');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'upd_title' => 'required|max:32',
        ]);
        $up_proj = Project::find($id);
        $up_proj->title = $request['upd_title'];
        if ($up_proj->title === NULL) {
            return redirect('/projects')->with('status_error', 'Project creation failed.');
        }
        return ($up_proj->save() == 1) ?
            redirect('/projects')->with('status_success', 'Project info updated!') :
            redirect('/projects')->with('status_error', 'Project update failed.');
    }
}
