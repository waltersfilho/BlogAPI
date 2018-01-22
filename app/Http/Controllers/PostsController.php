<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments')->get();

        return response($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:10'
        );

        error_log(implode("",$request->all()));

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator->errors();
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        return response()->json(['message' => 'Post created']);
        error_log($post);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post == null)
            return response()->json(['message' => 'Post not found']);

        return response($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:10'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator->errors();
        }

        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;


        error_log($post);

        $post->save();
        return response()->json(['message' => 'Post updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post==null)
            return response()->json(['message' => 'Post not found']);

        $post->delete();
        return response()->json(['message' => 'Post destroyed']);

    }
}
