<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\followeditemsbyuser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class CustomerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $state = StateController::getStates();
        return view("website.frontend.customer.CustomerHome", ['states' => $state ]);
        // return view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
    public function itemProfile($id = null)
    {
        //
        
        $state = StateController::getStates();
        $posts = PostsController::getItemPosts($id);
        $comments = CommentsController::getPostComments($id);
        $replies = CommentsController::getPostreplies($id);


        $item = DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $id)->first();

        $cover = Cover_Page::all()->where('Item_Id', '=', $id)->first();

        $post_images = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)
            ->get()
            ->groupBy('Post_Id');

            $User_Id = Auth::id();
            $check_follow=followeditemsbyuser::all()->where('Item_Id','=',$id)->where('User_ID','=',$User_Id);
            
        
            return view(
            'website\frontend\customer\Item_Profile_Posts',
            [
                'states' => $state,
                'posts' => $posts,
                'item' => $item,
                'cover' => $cover,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies,
                'check_follow'=>$check_follow
            ]
        );
    }

    public function itemDetails($id)
    {
        //

        $state = StateController::getStates();

        $item = DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $id)->first();

        $cover = Cover_Page::all()->where('Item_Id', '=', $id)->first();
        //schedule and location



        return view('website\frontend\customer\Item_Profile_Details', ['states' => $state, 'item' => $item, 'cover' => $cover]);
    }

    public function itemProfileGallery($id)
    {
        //

        $state = StateController::getStates();

        $item = DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $id)->first();

        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(8);

        $cover = Cover_Page::all()->where('Item_Id', '=', $id)->first();

        return view('website\frontend\customer\Item_Profile_Gallery', ['states' => $state, 'item' => $item, 'cover' => $cover, 'gallery' => $gallery]);
    }
    public function itemProfileReviews($id = null)
    {
        //

        $state = StateController::getStates();
        $reviews = ReviewController::getItemReviews($id);

        $item = DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $id)->first();

        $cover = Cover_Page::all()->where('Item_Id', '=', $id)->first();

        return view('website\frontend\customer\Item_Profile_Reviews', ['states' => $state, 'reviews' => $reviews, 'item' => $item, 'cover' => $cover]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function destroy(Request $request)
    {
    }

    public function findItemInState()
    {
        $state_id = StateController::findstatebyname(request('search'));

        $items = DB::table('streets')
            ->rightJoin('items', 'streets.Street_Id', '=', 'items.Street_Id')
            ->join('cover__pages', 'cover__pages.Item_Id', '=', 'items.Item_Id')
            ->where('State_Id', '=', $state_id)
            ->select('items.*', 'cover__pages.path')
            ->get();
        $state = StateController::getStates();

        return view('website.frontend.customer.TimeLine', ['states' => $state, 'items' => $items]);
    }


    public function findItemInStateAndDate()
    {
        $state_id = StateController::findstatebyname(request('search')); //3
        $arrivaldate = request('arrivaldate');
        $departuredate = request('departuredate');


        $items = DB::table('items')
            ->join('streets', 'streets.Street_Id', '=', 'items.Street_Id')
            ->join('schedules', 'schedules.Item_Id', '=', 'items.Item_Id')
            ->join('cover__pages', 'cover__pages.Item_Id', '=', 'items.Item_Id')
            ->where('streets.State_Id', '=', $state_id)
            ->orWhereDate('schedules.Start_Date', '<=', $arrivaldate)
            ->orWhereDate('schedules.End_Date', '>=', $departuredate)
            ->select('items.*', 'cover__pages.path')
            ->get();

          
        $state = StateController::getStates();

        return view('website.frontend.customer.TimeLine', ['states' => $state, 'items' => $items]);
    }

    public function FollowedItemPosts($item_id)
    {
        $posts = DB::table('posts')
        ->join('items','items.Item_Id','posts.Item_Id')
        ->where('posts.Item_Id','=',$item_id)
        ->select('posts.*')
        ->get();

        return view('website.frontend.customer.TimeLine', ['posts' => $posts]);

    }

    public function HomePagePosts ()
    {
        $User_Id = Auth::id();

        $posts = DB::table('followeditemsbyusers')
        ->join('posts','followeditemsbyusers.Item_Id','posts.Item_Id')
        ->join('items','followeditemsbyusers.Item_Id','items.Item_Id')
        ->select('posts.*','items.Item_Name')
        ->where('followeditemsbyusers.User_ID','=',$User_Id )
        ->get();

        

        $post_images = DB::table('post_attachments')
        ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id') 
        ->join('followeditemsbyusers','followeditemsbyusers.Item_Id','post_attachments.Item_Id')
        ->select('post_attachments.*', 'attachments.File_Path')
        ->get()
        ->groupBy('Post_Id');

        
        $comments=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->where('Parent_Comment','=',null)
        ->where('posts.Item_Id','=',$item_id)
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name')
        ->get()
        ->groupBy('Post_Id');

        $replies=DB::table('comments')
        ->join('posts', 'posts.Post_Id', '=', 'comments.Post_Id')
        ->join('users', 'users.id', '=', 'comments.User_Id')
        ->where('comments.Parent_Comment','!=',null)
        ->where('posts.Item_Id','=',$item_id)
        ->select('comments.*', 'users.First_Name','users.Middle_Name','users.Last_Name')
        ->get()
        ->groupBy('Parent_Comment');
       return $comments;

        return view("website.frontend.customer.HomePagePosts", ['posts'=>$posts ,'post_images'=>$post_images]);

    }
}
