<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\followeditemsbyuser;
use App\Item;
use App\review;
use App\review_attacment;
use App\User;
use Illuminate\Support\Facades\Auth;

class ItemProfileController extends Controller
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
        try{
        return view("website.frontend.owner.CustomerHome", ['states' => $state]);
        // return view('');
    }
    catch (\Exception $e) {
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
        $user = User::all()->where('id', '=', $id)->first();

        $posts = PostsController::userPosts($id);
        $profile_photo = ProfilePhotoController::getPhoto($id);
        $cover_photo = CoverPhotoController::getPhoto($id);
        $post_images = AttachmentController::getPostAttachments($id);
        $gallery = AttachmentController::getAttachmentsOfuser($id);
        $check_follow = FollowedusersController::checkFollow($id);
        $post_images = [];

        foreach ($posts as $post) {
            $post_image = AttachmentController::getAttachmentsOfPosts($post->Post_Id);

            $post_images = collect($post_images)->merge($post_image);
        }
try{
        if ($post_images != null) {
            $post_images = $post_images->groupby('Post_Id');
        }

        $User = Auth::user();

        // commented for test only
        if ($id == Auth::id()) {
            return view('website\frontend\customer\Customer_Own_Profile', [
                'id' => $id,
                'User' => $User,
                'First_Name' => $user->First_Name,
                'Email' => $user->email,
                'Middle_Name' => $user->Middle_Name,
                'Last_Name' => $user->Last_Name,
                'Cover_Photo' => $cover_photo,
                'Profile_Photo' => $profile_photo,
                'posts' => $posts,
                'post_images' => $post_images,
                'followedItems' => $user->followedItems,
                'gallery' => $gallery,
                'items' => $user->items,
            ]);
        }

        return view('website\frontend\customer\Customer_Profile', [
            'id' => $id,
            'User' => $User,
            'First_Name' => $user->First_Name,
            'Middle_Name' => $user->Middle_Name,
            'Last_Name' => $user->Last_Name,
            'Cover_Photo' => $cover_photo,
            'Profile_Photo' => $profile_photo,
            'posts' => $posts,
            'post_images' => $post_images,
            'followedItems' => $user->followedItems,
            'gallery' => $gallery,
            'items' => $user->items,
            'check_follow' =>  $check_follow,

        ]);}
        catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
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

        // return $i->street->country->Country_Name;
        $state = StateController::getStates();
        $posts = PostsController::getItemPosts($id);
        $comments = CommentsController::getPostComments($id);
        $replies = CommentsController::getPostreplies($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $post_images = AttachmentController::getPostAttachments($id);
        try{
        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(6);
      
        $item = Item::find($id);

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        $User = Auth::user();
        
        return view(
            'website\frontend\customer\Item_Profile_Posts',
            [
                'User'=>$User,
                'states' => $state,
                'posts' => $posts,
                'item' => $item,
                'cover' => $cover,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies,
                'check_follow' => $check_follow,
                'gallery' => $gallery

            ]
        );
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public function itemDetails($id)
    {
        //

        $schedule = ScheduleController::getAvailableTime($id);
        // return $schedule;

        $state = StateController::getStates();

        $item = Item::find($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);

        //schedule and location

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);
try{
        $details = DB::table('details')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->join('datatypes', 'datatypes.id', '=', 'property__details.DataType_Id')
            ->select('details.*', 'sub__type__properties.Property_Name', 'property__details.Detail_Name', 'datatypes.datatype')
            ->get()->where('Item_Id', '=', $id)->groupBy(['Property_Name', 'Property_Id', 'Property_diff']);


        return view('website\frontend\customer\Item_Profile_Details', ['details' => $details, 'states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }

    public function itemProfileGallery($id)
    {
        //
        $state = StateController::getStates();

        $item = Item::find($id);
try{
        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(8);

        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        return view('website\frontend\customer\Item_Profile_Gallery', ['states' => $state, 'item' => $item, 'cover' => $cover, 'gallery' => $gallery, 'check_follow' => $check_follow]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function itemProfileReviews($id = null)
    {
        //

        $state = StateController::getStates();
        $reviews = ReviewController::getItemReviews($id);
        $item = Item::find($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $post_images =Db::table('review_attacments')
        ->where('Item_Id','=',$id)
        ->get()
        ->groupBy('Review_Id');

        $comments = ReviewcommentsController::getPostComments($id);
        $replies = ReviewcommentsController::getPostreplies($id);

        $item = Item::find($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);

        $User_Id = Auth::id();
        try{
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        $AuthReview = review::all()->where('Item_Id', '=', $id)->where('User_Id', '=', $User_Id)->first();
        $User = Auth::user();

        return view('website\frontend\customer\Item_Profile_Reviews', ['User'=>$User,'states' => $state, 'reviews' => $reviews, 'comments' => $comments,
        'replies' => $replies, 'post_images' => $post_images, 'item' => $item, 'cover' => $cover, 'check_follow' => $check_follow, 'itemID' => $id, 'AuthReview' => $AuthReview]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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
}
