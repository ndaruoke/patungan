<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Users::orderBy('id', 'asc')->get();
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
        $users = new Users;

        $users->title = $request->input('title');
        $users->content = $request->input('content');
        $users->creator = $request->input('creator');
        $users->publish_date = $request->input('publish_date');
        $users->active = $request->input('active');
        $users->created_at = $request->input('created_at');
        $users->updated_at = $request->input('updated_at');
        $users->save();

        return 'Users record successfully created with id ' . $users->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Users::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $users = Users::find($id);

        $users->title = $request->input('title');
        $users->content = $request->input('content');
        $users->creator = $request->input('creator');
        $users->publish_date = $request->input('publish_date');
        $users->active = $request->input('active');
        $users->created_at = $request->input('created_at');
        $users->updated_at = $request->input('updated_at');
        $users->save();

        return "Sucess updating user #" . $users->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $users = Users::find($request->input('id'));

        $users->delete();

        return "Users record successfully deleted #" . $request->input('id');
    }
}
