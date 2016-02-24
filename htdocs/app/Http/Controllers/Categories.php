<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Categories::orderBy('id', 'asc')->get();
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
        $categories = new Categories;

        $categories->name = $request->input('name');
        $categories->summary = $request->input('summary');
        $categories->detail = $request->input('detail');
        $categories->category = $request->input('category');
        $categories->amount_funding = $request->input('amount_funding');
        $categories->funding_duration = $request->input('funding_duration');
        $categories->reward = $request->input('reward');
        $categories->time = $request->input('time');
        $categories->status = $request->input('status');
        $categories->image = $request->input('image');
        $categories->video = $request->input('video');
        $categories->home = $request->input('home');
        $categories->update = $request->input('update');
        $categories->user_id = $request->input('user_id');
        $categories->featured = $request->input('featured');
        $categories->active = $request->input('active');
        $categories->created_at = $request->input('created_at');
        $categories->updated_at = $request->input('updated_at');
        $categories->save();

        return 'Categories record successfully created with id ' . $categories->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Categories::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $categories = Categories::find($id);

        $categories->name = $request->input('name');
        $categories->summary = $request->input('summary');
        $categories->detail = $request->input('detail');
        $categories->category = $request->input('category');
        $categories->amount_funding = $request->input('amount_funding');
        $categories->funding_duration = $request->input('funding_duration');
        $categories->reward = $request->input('reward');
        $categories->time = $request->input('time');
        $categories->status = $request->input('status');
        $categories->image = $request->input('image');
        $categories->video = $request->input('video');
        $categories->home = $request->input('home');
        $categories->update = $request->input('update');
        $categories->user_id = $request->input('user_id');
        $categories->featured = $request->input('featured');
        $categories->active = $request->input('active');
        $categories->created_at = $request->input('created_at');
        $categories->updated_at = $request->input('updated_at');
        $categories->save();

        return "Sucess updating user #" . $categories->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $categories = Categories::find($request->input('id'));

        $categories->delete();

        return "Categories record successfully deleted #" . $request->input('id');
    }
}
