<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Project extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Project::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $project = new Project;

        $project->name = $request->input('name');
        $project->summary = $request->input('summary');
        $project->detail = $request->input('detail');
        $project->category = $request->input('category');
        $project->amount_funding = $request->input('amount_funding');
        $project->funding_duration = $request->input('funding_duration');
        $project->reward = $request->input('reward');
        $project->time = $request->input('time');
        $project->status = $request->input('status');
        $project->image = $request->input('image');
        $project->video = $request->input('video');
        $project->home = $request->input('home');
        $project->update = $request->input('update');
        $project->user_id = $request->input('user_id');
        $project->featured = $request->input('featured');
        $project->active = $request->input('active');
        $project->created_at = $request->input('created_at');
        $project->updated_at = $request->input('updated_at');
        $project->save();

        return 'Project record successfully created with id ' . $project->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Project::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->summary = $request->input('summary');
        $project->detail = $request->input('detail');
        $project->category = $request->input('category');
        $project->amount_funding = $request->input('amount_funding');
        $project->funding_duration = $request->input('funding_duration');
        $project->reward = $request->input('reward');
        $project->time = $request->input('time');
        $project->status = $request->input('status');
        $project->image = $request->input('image');
        $project->video = $request->input('video');
        $project->home = $request->input('home');
        $project->update = $request->input('update');
        $project->user_id = $request->input('user_id');
        $project->featured = $request->input('featured');
        $project->active = $request->input('active');
        $project->created_at = $request->input('created_at');
        $project->updated_at = $request->input('updated_at');
        $project->save();

        return "Sucess updating user #" . $project->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $project = Project::find($request->input('id'));

        $project->delete();

        return "Project record successfully deleted #" . $request->input('id');
    }
}
