<?php

namespace App\Http\Controllers;


use App\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\followeditemsbyuser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;


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
        return view("website.frontend.owner.CustomerHome", ['states' => $state]);
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
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $post_images = AttachmentController::getPostAttachments($id);
        $item = AddUserController::getItemWithOwnerName($id);

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        return view(
            'website\frontend\owner\Item_Profile_Posts',
            [
                'states' => $state,
                'posts' => $posts,
                'item' => $item,
                'cover' => $cover,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies,
                'check_follow' => $check_follow
            ]
        );
    }

    public function itemDetails($id)
    {
        //

        $schedule = ScheduleController::getAvailableTime($id);
        // return $schedule;

        $state = StateController::getStates();

        $item = AddUserController::getItemWithOwnerName($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        //schedule and location

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);


        return view('website\frontend\owner\Item_Profile_Details', ['states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow]);
    }

    public function itemProfileGallery($id)
    {
        //
        $state = StateController::getStates();

        $item = AddUserController::getItemWithOwnerName($id);

        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(8);

        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        return view('website\frontend\owner\Item_Profile_Gallery', ['states' => $state, 'item' => $item, 'cover' => $cover, 'gallery' => $gallery, 'check_follow' => $check_follow]);
    }

    public function itemProfileReviews($id = null)
    {
        //

        $state = StateController::getStates();
        $reviews = ReviewController::getItemReviews($id);
        $item = AddUserController::getItemWithOwnerName($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        return view('website\frontend\owner\Item_Profile_Reviews', ['states' => $state, 'reviews' => $reviews, 'item' => $item, 'cover' => $cover, 'check_follow' => $check_follow]);
    }

    public function itemReservations($id = null)
    {
        $reservation_details = DB::table('operation___detail__values')
        ->join('operation__detail_name', 'operation__detail_name.Detail_Id', '=', 'operation___detail__values.Detail_Id')
        ->join('operations', 'operations.Operation_Id', '=', 'operation___detail__values.Operation_Id')
        ->select('operation___detail__values.*','operation__detail_name.Operation_Detail_Name','operations.Item_Id')
        ->where('operations.Item_Id','=',$id)
        ->get()
        ->groupBy('Operation_Id');

        $reservations= DB::table('operations')
        ->join('items', 'items.Item_Id', '=', 'operations.Item_Id')
        ->join('users', 'users.id', '=', 'operations.User_Id')
        ->select('operations.*','items.Item_Name','users.First_Name', 'users.Middle_Name', 'users.Last_Name')
        ->where('operations.Item_Id','=',$id)
        ->get();
        
        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $item = AddUserController::getItemWithOwnerName($id);
        // return dd($reservation_details);
        return view('website.frontend.owner.Item_Profile_Reservations',['reservations'=>$reservations,'reservation_details'=>$reservation_details,'item' => $item,'cover'=>$cover,'check_follow' => $check_follow]);



    }

// function for page ownerManageSchedule 
    public function itemManageSchedule($id = null)
    {
        
        $schedule = ScheduleController::getWholeSchedule($id);
        // return $schedule;

        $item = AddUserController::getItemWithOwnerName($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        //schedule and location

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

// return $schedule;
        return view('website\frontend\owner\Item_Profile_Manage_Schedule', [ 'item' => $item, 'cover' => $cover, 'schedules' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow]);
  


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
}
