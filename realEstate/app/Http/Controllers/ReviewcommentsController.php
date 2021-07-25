<?php

namespace App\Http\Controllers;

use App\comments;
use App\review;
use App\reviewcomments;
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
    public function editComment()
    {
        DB::beginTransaction();

        try {

            $comment = reviewcomments::all()->find(request('id'));
            $comment->Comment = request('edit_Comment');
            $comment->save();

            DB::commit();
            return back()->with('info', 'Comment Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing item');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        try {
            $comment = reviewcomments::create([
                'Post_Id' => request('post_id'),
                'User_Id' => Auth::id(),
                'Comment'  => request('comment')
            ]);


            //send notification to poster 
            $to_user = review::all()->where('Review_Id', '=', request('post_id'))->first()->user->id;

            NotificationController::create(Auth::id(), $to_user, 'Commented on your Review');

            $comment = DB::table('reviewcomments')
                ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
                ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
                ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
                ->where('reviewcomments.Comment_Id', '=', $comment->Comment_Id)
                ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
                ->get()->first();


            return response()->json($comment);
        } catch (\Exception $e) {
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
            $to_user = reviewcomments::all()->where('Comment_Id', '=', request('parent_id'));
            NotificationController::create(Auth::id(), $to_user, 'Replyed to your comment');

            $comment = DB::table('reviewcomments')
                ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
                ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
                ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
                ->where('Parent_Comment', '=', request('parent_id'))
                ->where('reviewcomments.Comment_Id', '=', $comment->Comment_Id)
                ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
                ->get()->first();

            DB::commit();
            return response()->json($comment);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function DestroyComment($id = null)
    {
        //
        DB::beginTransaction();

        if ($id == null) {
            if (request()->has('id'))
                $id = request('id');
        }

        try {
            reviewcomments::destroy($id);
            $reviewcomments = reviewcomments::all()->where('Parent_Comment', '=', $id);
            foreach ($reviewcomments as $comment) {
                reviewcomments::destroy($comment->Comment_Id);
            }

            DB::commit();
            return  redirect()->back()->with('success', 'Comment Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Comment cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroyReply($id)
    {
        //
        DB::beginTransaction();

        try {
            reviewcomments::destroy($id);
            DB::commit();
            return  redirect()->back()->with('success', 'Reply Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Reply cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public static function getPostComments($item_id)
    {
        //
try{
        $reviewcomments = DB::table('reviewcomments')
            ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
            ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
            ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
            ->where('Parent_Comment', '=', null)
            ->where('reviews.Item_Id', '=', $item_id)
            ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
            ->get()
            ->groupBy('Post_Id');

        return $reviewcomments;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public static function getPostreplies($item_id)
    {
        //
try{
        $reviewcomments = DB::table('reviewcomments')
            ->join('reviews', 'reviews.Review_Id', '=', 'reviewcomments.Post_Id')
            ->join('users', 'users.id', '=', 'reviewcomments.User_Id')
            ->LeftJoin('profile_photos', 'profile_photos.User_Id', '=', 'reviewcomments.User_Id')
            ->where('reviewcomments.Parent_Comment', '!=', null)
            ->where('reviews.Item_Id', '=', $item_id)
            ->select('reviewcomments.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
            ->get()
            ->groupBy('Parent_Comment');

        return $reviewcomments;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
}
