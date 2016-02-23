<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectReward extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return ProjectReward::orderBy('id', 'asc')->get();
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
        $projectReward = new ProjectReward;

        $projectReward->name = $request->input('name');
        $projectReward->summary = $request->input('summary');
        $projectReward->detail = $request->input('detail');
        $projectReward->category = $request->input('category');
        $projectReward->amount_funding = $request->input('amount_funding');
        $projectReward->funding_duration = $request->input('funding_duration');
        $projectReward->reward = $request->input('reward');
        $projectReward->time = $request->input('time');
        $projectReward->status = $request->input('status');
        $projectReward->image = $request->input('image');
        $projectReward->video = $request->input('video');
        $projectReward->home = $request->input('home');
        $projectReward->update = $request->input('update');
        $projectReward->user_id = $request->input('user_id');
        $projectReward->featured = $request->input('featured');
        $projectReward->active = $request->input('active');
        $projectReward->created_at = $request->input('created_at');
        $projectReward->updated_at = $request->input('updated_at');
        $projectReward->save();

        return 'ProjectReward record successfully created with id ' . $projectReward->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return ProjectReward::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $projectReward = ProjectReward::find($id);

        $projectReward->name = $request->input('name');
        $projectReward->summary = $request->input('summary');
        $projectReward->detail = $request->input('detail');
        $projectReward->category = $request->input('category');
        $projectReward->amount_funding = $request->input('amount_funding');
        $projectReward->funding_duration = $request->input('funding_duration');
        $projectReward->reward = $request->input('reward');
        $projectReward->time = $request->input('time');
        $projectReward->status = $request->input('status');
        $projectReward->image = $request->input('image');
        $projectReward->video = $request->input('video');
        $projectReward->home = $request->input('home');
        $projectReward->update = $request->input('update');
        $projectReward->user_id = $request->input('user_id');
        $projectReward->featured = $request->input('featured');
        $projectReward->active = $request->input('active');
        $projectReward->created_at = $request->input('created_at');
        $projectReward->updated_at = $request->input('updated_at');
        $projectReward->save();

        return "Sucess updating user #" . $projectReward->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $projectReward = ProjectReward::find($request->input('id'));

        $projectReward->delete();

        return "ProjectReward record successfully deleted #" . $request->input('id');
    }
}
