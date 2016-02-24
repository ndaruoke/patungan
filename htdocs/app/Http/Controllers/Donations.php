<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Donations extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Donations::orderBy('id', 'asc')->get();
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
        $donations = new Donations;

        $donations->amount = $request->input('amount');
        $donations->time = $request->input('time');
        $donations->reward_status = $request->input('reward_status');
        $donations->donation_status = $request->input('donation_status');
        $donations->bank_account = $request->input('bank_account');
        $donations->user_id = $request->input('user_id');
        $donations->project_id = $request->input('project_id');
        $donations->active = $request->input('active');
        $donations->created_at = $request->input('created_at');
        $donations->updated_at = $request->input('updated_at');
        $donations->save();

        return 'Donations record successfully created with id ' . $donations->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Donations::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $donations = Donations::find($id);

        $donations->amount = $request->input('amount');
        $donations->time = $request->input('time');
        $donations->reward_status = $request->input('reward_status');
        $donations->donation_status = $request->input('donation_status');
        $donations->bank_account = $request->input('bank_account');
        $donations->user_id = $request->input('user_id');
        $donations->project_id = $request->input('project_id');
        $donations->active = $request->input('active');
        $donations->created_at = $request->input('created_at');
        $donations->updated_at = $request->input('updated_at');
        $donations->save();

        return "Sucess updating user #" . $donations->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $donations = Donations::find($request->input('id'));

        $donations->delete();

        return "Donations record successfully deleted #" . $request->input('id');
    }
}
