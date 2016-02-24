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

        $projectReward->project_id = $request->input('project_id');
        $projectReward->reward_1 = $request->input('reward_1');
        $projectReward->reward_2 = $request->input('reward_2');
        $projectReward->reward_3 = $request->input('reward_3');
        $projectReward->reward_4 = $request->input('reward_4');
        $projectReward->reward_5 = $request->input('reward_5');
        $projectReward->count_1 = $request->input('count_1');
        $projectReward->count_2 = $request->input('count_2');
        $projectReward->count_3 = $request->input('count_3');
        $projectReward->count_4 = $request->input('count_4');
        $projectReward->count_5 = $request->input('count_5');
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

        $projectReward->project_id = $request->input('project_id');
        $projectReward->reward_1 = $request->input('reward_1');
        $projectReward->reward_2 = $request->input('reward_2');
        $projectReward->reward_3 = $request->input('reward_3');
        $projectReward->reward_4 = $request->input('reward_4');
        $projectReward->reward_5 = $request->input('reward_5');
        $projectReward->count_1 = $request->input('count_1');
        $projectReward->count_2 = $request->input('count_2');
        $projectReward->count_3 = $request->input('count_3');
        $projectReward->count_4 = $request->input('count_4');
        $projectReward->count_5 = $request->input('count_5');
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
