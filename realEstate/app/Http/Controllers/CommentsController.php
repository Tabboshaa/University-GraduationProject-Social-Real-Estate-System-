<?php

namespace App\Http\Controllers;

use App\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // try {
            $comment=comments::create([
                'Post_Id' => request('post_id'),
                'User_Id'=> Auth::id(),
                'Comment'  => request('comment')
            ]);
           return response()->json($comment);
        // }catch (\Illuminate\Database\QueryException $e){

        // }
    }
    public function reply()
    {
        //

        // try {
            $comment=comments::create([
                'Post_Id' => request('post_id'),
                'User_Id'=> Auth::id(),
                'Parent_Comment' => request('parent_id'),
                'Comment'  => request('comment')
            ]);
           return response()->json($comment);
        // }catch (\Illuminate\Database\QueryException $e){

        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getPostComments($post_id)
    {
        //
        $comments = comments::all()->where('Post_Id', '=', $post_id)->where('Parent_Comment','=',null);

        $comments=DB::table('comments')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->where('Parent_Comment','=',null)->paginate(10);

        return $comments;
    }

    public static function getPostreplies($post_id)
    {
        //
        $comments = comments::all()->where('Parent_Comment', '=', $post_id)->where('Parent_Comment','!=',null);

        $comments=DB::table('comments')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->where('Parent_Comment','=',$post_id)->paginate(10);

        return $comments;
    }
}
