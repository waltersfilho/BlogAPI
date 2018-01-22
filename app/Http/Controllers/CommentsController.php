<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return response($comments);
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
            'body' => 'required|min:10',
            'post_id' => 'required'
        );

        error_log(implode("",$request->all()));

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator->errors();
        }

        $comment = new Comment();
        $post = Post::find($request->post_id);

        if($post == null)
            return response()->json(['message' => 'Post not found']);

        $comment->body = $request->body;

        $post->comments()->save($comment);

        return response()->json(['message' => 'Comment created']);
        error_log($comment);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if ($comment == null)
            return response()->json(['message' => 'Comment not found']);

        return response($comment);
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
            'body' => 'required|min:10'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator->errors();
        }

        $comment = Comment::find($id);
        $post = Post::find($request->post_id);

        if($post == null)
            return response()->json(['message' => 'Post not found']);

        $comment->body = $request->body;


        error_log($comment);

        $post->comments()->save($comment);

        return response()->json(['message' => 'Comment updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment==null)
            return response()->json(['message' => 'Comment not found']);

        $comment->delete();
        return response()->json(['message' => 'Comment destroyed']);

    }
}
