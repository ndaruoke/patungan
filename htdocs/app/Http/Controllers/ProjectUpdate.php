<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectUpdate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return ProjectUpdate::orderBy('id', 'asc')->get();
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
        $projectUpdate = new ProjectUpdate;

        $projectUpdate->project_id = $request->input('project_id');
        $projectUpdate->user_id_comment = $request->input('user_id_comment');
        $projectUpdate->title_comment = $request->input('title_comment');
        $projectUpdate->content_comment = $request->input('content_comment');
        $projectUpdate->active = $request->input('active');
        $projectUpdate->created_at = $request->input('created_at');
        $projectUpdate->updated_at = $request->input('updated_at');
        $projectUpdate->save();

        return 'ProjectUpdate record successfully created with id ' . $projectUpdate->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return ProjectUpdate::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $projectUpdate = ProjectUpdate::find($id);

        $projectUpdate->name = $request->input('name');
        $projectUpdate->summary = $request->input('summary');
        $projectUpdate->detail = $request->input('detail');
        $projectUpdate->category = $request->input('category');
        $projectUpdate->amount_funding = $request->input('amount_funding');
        $projectUpdate->funding_duration = $request->input('funding_duration');
        $projectUpdate->reward = $request->input('reward');
        $projectUpdate->time = $request->input('time');
        $projectUpdate->status = $request->input('status');
        $projectUpdate->image = $request->input('image');
        $projectUpdate->video = $request->input('video');
        $projectUpdate->home = $request->input('home');
        $projectUpdate->update = $request->input('update');
        $projectUpdate->user_id = $request->input('user_id');
        $projectUpdate->featured = $request->input('featured');
        $projectUpdate->active = $request->input('active');
        $projectUpdate->created_at = $request->input('created_at');
        $projectUpdate->updated_at = $request->input('updated_at');
        $projectUpdate->save();

        return "Sucess updating user #" . $projectUpdate->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $projectUpdate = ProjectUpdate::find($request->input('id'));

        $projectUpdate->delete();

        return "ProjectUpdate record successfully deleted #" . $request->input('id');
    }
}
