<?php

namespace App\Http\Controllers;


use App\Phone_Numbers;
use App\Type_Of_User;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\followeditemsbyuser;
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
        $user_id = Auth::id();
        $user = Type_Of_User::all()->where('User_ID', '=', $user_id)->where('User_Type_ID', '=', 3);

        $phone = Phone_Numbers::all()->where('User_ID', '=', $user_id)->first();
        if ($user == '[]') {
            $user = '0';
        } else {
            $user = '1';
        }
        return view("website.frontend.customer.CustomerHome", ['states' => $state, 'checkIfOwner' => $user, 'phone' => $phone]);
    }
    public static function checkIfOwner()
    {
        $user = Type_Of_User::all()->where('User_ID', '=', Auth::id())->where('User_Type_ID', '=', 3);
    }
    public function indexPhoto()
    {

        $States = DB::table('state_photos')
            ->join('states', 'states.State_Id', '=', 'state_photos.State_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'state_photos.Attachment_Id')
            ->select('state_photos.*', 'attachments.File_Path', 'states.State_Name')->get();

        return view('website.frontend.customer.CustomerHome',['StatesPhotos' => $States]);
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
            ->select('items.*', 'cover__pages.path')->get();


        $state = StateController::getStates();

        return view('website.frontend.customer.TimeLine', ['states' => $state, 'items' => $items]);
    }

    public function findItemInStateAndDate()
    {
        $state_id = StateController::findstatebyname(request('state')); //3
        $arrivaldate = request('arrivaldate');
        $departuredate = request('departuredate');

        $User_Id = Auth::id();

        $items = DB::table('items')
            ->join('streets', 'streets.Street_Id', '=', 'items.Street_Id')
            ->join('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'streets.State_Id', '=', 'states.State_Id')
            ->join('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->join('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->join('schedules', 'schedules.Item_Id', '=', 'items.Item_Id')
            ->LeftJoin('cover__pages', 'cover__pages.Item_Id', '=', 'items.Item_Id')
            ->where('streets.State_Id', '=', $state_id)
            ->WhereDate('schedules.Start_Date', '<=', $arrivaldate)
            ->WhereDate('schedules.End_Date', '>=', $departuredate)
            ->select('items.*', 'cover__pages.path', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name', 'regions.Region_Name', 'streets.Street_Name')
            ->get();

        $details = [];
        $reviews = [];
        if ($items != null) {
            foreach ($items as $item) {

                $review = [" " . $item->Item_Id . " " => ReviewController::getItemRate($item->Item_Id)];

                $detail = DB::table('details')
                    ->join('sub__type__properties', 'sub__type__properties.Property_Id', '=', 'details.Property_Id')
                    ->groupBy('details.Property_Id', 'details.Item_Id', 'sub__type__properties.Property_Name')
                    ->selectRaw('details.Item_Id , sub__type__properties.Property_Name  , COUNT(DISTINCT Property_diff) as count')
                    ->where('Item_Id', '=', $item->Item_Id)
                    ->get()
                    ->groupBy('Item_Id');

                $details = collect($details)->merge([$detail]);
                $reviews = collect($reviews)->merge($review);
            }
        }

        $check_follow = followeditemsbyuser::all()->where('User_ID', '=', $User_Id)->groupBy('Item_Id');

        $state = StateController::getStates();

        return view('website.frontend.customer.TimeLine', ['states' => $state, 'items' => $items, 'check_follow' => $check_follow, 'details' => $details, 'reviews' => $reviews]);
    }

    public function FollowedItemPosts($item_id)
    {
        $posts = DB::table('posts')
            ->join('items', 'items.Item_Id', 'posts.Item_Id')
            ->where('posts.Item_Id', '=', $item_id)
            ->select('posts.*')
            ->get();

        return view('website.frontend.customer.TimeLine', ['posts' => $posts]);
    }


    public function HomePagePosts()
    {

        $User = Auth::user();

        $newestitems = ItemController::getnewestitems();
        $mostPopularitems = ItemController::getpopularitems();
        //    return $newestitems[5]->coverpage->path;


        $posts = DB::table('followeditemsbyusers')
            ->join('posts', 'followeditemsbyusers.Item_Id', 'posts.Item_Id')
            ->join('items', 'followeditemsbyusers.Item_Id', 'items.Item_Id')
            ->Leftjoin('cover__pages', 'cover__pages.Item_Id', 'followeditemsbyusers.Item_Id')
            ->select('posts.*', 'items.Item_Name', 'cover__pages.path')
            ->where('followeditemsbyusers.User_ID', '=', $User->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $cover__pages = DB::table('cover__pages')
            ->join('items', 'items.Item_Id', 'cover__pages.Item_Id')
            ->select('cover__pages.*')
            ->get();

        $items = item::all();

        $post_images = DB::table('post_attachments')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->join('followeditemsbyusers', 'followeditemsbyusers.Item_Id', 'post_attachments.Item_Id')
            ->select('post_attachments.*', 'attachments.File_Path')
            ->get()
            ->groupBy('Post_Id');


        $comments = [];
        $replies = [];

        if ($posts != null) {
            foreach ($posts as $post) {
                $comment = CommentsController::getPostCommentsHomePage($post->Post_Id);

                $comments = collect($comments)->merge($comment);


                $reply = CommentsController::getPostrepliesHomePage($post->Post_Id);
                $replies = collect($replies)->merge($reply);
            }
        }
        if ($comments != null) {
            $comments = $comments->groupBy('Post_Id');
            if ($replies != null) {
                $replies = $replies->groupby('Parent_Comment');
            }
        }
        // return $comments;

        $check_follow = followeditemsbyuser::all()->where('User_ID', '=', $User->id);

        return view(
            "website.frontend.customer.HomePagePosts",
            [
                'posts' => $posts,
                'items' => $items,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies,
                'cover__pages' => $cover__pages,
                'check_follow' => $check_follow,
                'User' => $User,
                'newestitems' => $newestitems,
                'mostPopularitems' => $mostPopularitems
            ]
        );
    }
    //funtion that gets posts by the users gthe user follows
    public function HomePageUserPosts()
    {

        $User = Auth::user();

        $newestitems = ItemController::getnewestitems();
        $mostPopularitems = ItemController::getpopularitems();

        $posts = DB::table('followedusers')
            ->join('posts', 'followedusers.following_user', 'posts.User_Id')
            ->join('users', 'followedusers.following_user', 'users.id')
            ->Leftjoin('profile_photos', 'profile_photos.User_Id', 'followedusers.following_user')
            ->select('posts.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name', 'profile_photos.Profile_Picture')
            ->where('followedusers.user_id', '=', $User->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $cover__pages = DB::table('cover__pages')
            ->join('items', 'items.Item_Id', 'cover__pages.Item_Id')
            ->select('cover__pages.*')
            ->get();

        $items = item::all();

        $post_images = [];

        foreach ($posts as $post) {
            $post_image = AttachmentController::getAttachmentsOfPosts($post->Post_Id);

            $post_images = collect($post_images)->merge($post_image);
        }

        if ($post_images != null) {
            $post_images = $post_images->groupby('Post_Id');
        }


        $comments = [];
        $replies = [];

        if ($posts != null) {
            foreach ($posts as $post) {
                $comment = CommentsController::getPostCommentsHomePage($post->Post_Id);

                $comments = collect($comments)->merge($comment);


                $reply = CommentsController::getPostrepliesHomePage($post->Post_Id);
                $replies = collect($replies)->merge($reply);
            }
        }
        if ($comments != null) {
            $comments = $comments->groupBy('Post_Id');
            if ($replies != null) {
                $replies = $replies->groupby('Parent_Comment');
            }
        }
        // return $replies;

        $check_follow = followeditemsbyuser::all()->where('User_ID', '=', $User->id);

        return view(
            "website.frontend.customer.HomePageUserPosts",
            [
                'posts' => $posts,
                'items' => $items,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies,
                'cover__pages' => $cover__pages,
                'check_follow' => $check_follow,
                'User' => $User,
                'newestitems' => $newestitems,
                'mostPopularitems' => $mostPopularitems
            ]
        );
    }


    public function showReservation()
    {
    }
}
