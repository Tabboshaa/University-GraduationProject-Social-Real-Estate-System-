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
//send notification to poster 
            $to_user= PostsController::postCreatedBy(request('post_id'));
            NotificationController::create(Auth::id(),$to_user, 'Commented on your post');
            
            $comment=DB::table('comments')
            ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
            ->join('users', 'users.id', '=', 'comments.User_Id')
            ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
            ->where('Parent_Comment','=',null)
            ->where('comments.Comment_Id','=',$comment->Comment_Id)
            ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
            ->get()->first();

           return response()->json($comment);
        }catch (\Illuminate\Database\QueryException $e){
            return back()->withError($e->getMessage())->withInput();
        }
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
            //send notification to comment owner 
            $to_user= CommentsController::CommentCreatedBy(request('parent_id'));
            NotificationController::create(Auth::id(),$to_user, 'Replyed to your comment');

            $comment=DB::table('comments')
            ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
            ->join('users', 'users.id', '=', 'comments.User_Id')
            ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
            ->where('Parent_Comment','=',request('parent_id'))
            ->where('comments.Comment_Id','=',$comment->Comment_Id)
            ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
            ->get()->first();

           return response()->json($comment);
        }catch (\Illuminate\Database\QueryException $e){
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function CommentCreatedBy($id)
    {
        //
         $user=comments::all()->where('Comment_Id','=',$id)->first()->User_Id;
        return $user;
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
    public function destroyComment($id)
    {
        //
        try {
            comments::destroy($id);
            return  redirect()->back()->with('success', 'Comment Deleted Successfully');
        }catch (\Illuminate\Database\QueryException $e){

            return redirect()->back()->with('error', 'Comment cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
      
}

    public function destroyReply($id)
    {
        //
        try {
            comments::destroy($id);
            return  redirect()->back()->with('success', 'Reply Deleted Successfully');
        }catch (\Illuminate\Database\QueryException $e){

            return redirect()->back()->with('error', 'Reply cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
        
    }

    public static function getPostComments($item_id)
    {
        //

        $comments=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('Parent_Comment','=',null)
        ->where('posts.Item_Id','=',$item_id)
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get()
        ->groupBy('Post_Id');


        return $comments;
    }

    public static function getPostreplies($item_id)
    {
        //

        $comments=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('comments.Parent_Comment','!=',null)
        ->where('posts.Item_Id','=',$item_id)
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get()
        ->groupBy('Parent_Comment');



        return $comments;
    }

    public static function getPostCommentsHomePage ($post_id )
    {
        $comments=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('Parent_Comment','=',null)
        ->where('comments.Post_Id','=',$post_id )
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get();


        return $comments;
    }

    public static function getPostrepliesHomePage ($post_id )
    {
        $comments=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('comments.Parent_Comment','!=',null)
        ->where('comments.Post_Id','=',$post_id )
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get();

        return $comments;
    }
    public static function GetCommentReply ()
    {
        $comments=DB::table('comments')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('comments.Parent_Comment','=',request('comment_id'))
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get();

        return $comments;
    }
    public static function GetComments()
    {
        $comments=DB::table('comments')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->LeftJoin('profile_photos','profile_photos.User_Id','=','comments.User_Id')
        ->where('comments.Parent_Comment','!=',null)
        ->where('comments.Post_Id','=',request('post_id'))
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name','profile_photos.Profile_Picture')
        ->get();

        return $comments;
    }
}
