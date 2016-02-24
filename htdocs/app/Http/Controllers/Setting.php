<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Setting::orderBy('id', 'asc')->get();
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
        $setting = new Setting;

        $setting->title = $request->input('title');
        $setting->content = $request->input('content');
        $setting->creator = $request->input('creator');
        $setting->publish_date = $request->input('publish_date');
        $setting->active = $request->input('active');
        $setting->created_at = $request->input('created_at');
        $setting->updated_at = $request->input('updated_at');
        $setting->save();

        return 'Setting record successfully created with id ' . $setting->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Setting::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $setting = Setting::find($id);

        $setting->title = $request->input('title');
        $setting->content = $request->input('content');
        $setting->creator = $request->input('creator');
        $setting->publish_date = $request->input('publish_date');
        $setting->active = $request->input('active');
        $setting->created_at = $request->input('created_at');
        $setting->updated_at = $request->input('updated_at');
        $setting->save();

        return "Sucess updating user #" . $setting->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $setting = Setting::find($request->input('id'));

        $setting->delete();

        return "Setting record successfully deleted #" . $request->input('id');
    }
}
