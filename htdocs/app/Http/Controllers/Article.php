<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Article::orderBy('id', 'asc')->get();
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
        $article = new Article;

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->creator = $request->input('creator');
        $article->publish_date = $request->input('publish_date');
        $article->active = $request->input('active');
        $article->created_at = $request->input('created_at');
        $article->updated_at = $request->input('updated_at');
        $article->save();

        return 'Article record successfully created with id ' . $article->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Article::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $article = Article::find($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->creator = $request->input('creator');
        $article->publish_date = $request->input('publish_date');
        $article->active = $request->input('active');
        $article->created_at = $request->input('created_at');
        $article->updated_at = $request->input('updated_at');
        $article->save();

        return "Sucess updating user #" . $article->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $article = Article::find($request->input('id'));

        $article->delete();

        return "Article record successfully deleted #" . $request->input('id');
    }
}
