<?php

namespace App\Http\Controllers;

use App\review;
use App\reviewcomments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewcommentsController extends Controller
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
        DB::beginTransaction();
        try {
            $comment = reviewcomments::create([
                'Post_Id' => request('post_id'),
                'User_Id' => Auth::id(),
                'Comment'  => request('comment')
            ]);
            //send notification to poster 
            $to_user =review::all()->where('Review_id','=',request('post_id'))->first()->user->id;

            NotificationController::create(Auth::id(), $to_user, 'Commented on your post');

            $comment = DB::table('reviewcomments')
                ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
                ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
                ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
                ->where('Parent_Comment', '=', null)  
                ->where('comments.Comment_Id', '=', $comment->Comment_Id) 
                ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
                ->get()->first();;

            DB::commit();
            return response()->json($comment);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function reply()
    {
        //
        DB::beginTransaction();
        try {
            $comment = reviewcomments::create([
                'Post_Id' => request('post_id'),
                'User_Id' => Auth::id(),
                'Parent_Comment' => request('parent_id'),
                'Comment'  => request('comment')
            ]);
            //send notification to comment owner 
            $to_user = reviewcomments::all()->where('Comment_Id','=', request('parent_id'));
            NotificationController::create(Auth::id(), $to_user, 'Replyed to your comment');

            $comment = DB::table('comments')
                ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
                ->join('users', 'users.id', '=', 'comments.User_Id')
                ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'comments.User_Id')
                ->where('Parent_Comment', '=', request('parent_id'))
                ->where('comments.Comment_Id', '=', $comment->Comment_Id)
                ->select('comments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
                ->get()->first();

            DB::commit();
            return response()->json($comment);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\reviewcomments  $reviewcomments
     * @return \Illuminate\Http\Response
     */
    public function show(reviewcomments $reviewcomments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reviewcomments  $reviewcomments
     * @return \Illuminate\Http\Response
     */
    public function edit(reviewcomments $reviewcomments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reviewcomments  $reviewcomments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reviewcomments $reviewcomments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reviewcomments  $reviewcomments
     * @return \Illuminate\Http\Response
     */
    public function destroy(reviewcomments $reviewcomments)
    {
        //
    }

    public static function getPostComments($item_id)
    {
        //

        $comments = DB::table('reviewcomments')
            ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
            ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
            ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
            ->where('Parent_Comment', '=', null)
            ->where('reviews.Item_Id', '=', $item_id)
            ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
            ->get()
            ->groupBy('Post_Id');

        return $comments;
    }

    public static function getPostreplies($item_id)
    {
        //

        $comments = DB::table('reviewcomments')
            ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
            ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
            ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
            ->where('reviewcomments.Parent_Comment', '!=', null)
            ->where('reviews.Item_Id', '=', $item_id)
            ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
            ->get()
            ->groupBy('Parent_Comment');

        return $comments;
    }
}
