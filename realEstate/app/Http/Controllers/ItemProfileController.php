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

        $schedule = $this->getAvailableTime($id);
        // return $schedule;

        $state = StateController::getStates();

        $item = AddUserController::getItemWithOwnerName($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        //schedule and location

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);


        return view('website\frontend\owner\Item_Profile_Details', ['states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow]);
    }

    public function getAvailableTime($item_id)
    {
        //     get from Schedule endDate startDate where item id =$item_id

        $schedule = schedule::orderBy('Start_Date')->where('Item_Id', '=', $item_id)->get();

        $days = [];
        //get day of every schedule
        foreach ($schedule as $value) {

            $day = $this->getdays($value->Start_Date, $value->End_Date, $value->schedule_Id);
            //merge days
            $days = collect($days)->merge($day)->unique(); //unique 3shan mykrrsh date mrten
        }

        //group by month of date
        $days = collect($days)->groupBy(function ($val) {
            return Carbon::parse($val['date'])->format('m');
        })->toArray();

        return $days;
    }

    function getdays($start, $end, $schedule_id)
    {

        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );

        $interval = [];
        //enter start date
        $interval[] = [
            'date' => $start,
            'schedule_Id' => $schedule_id
        ];

        // }for loop to store interval in array
        foreach ($period as $key => $value) {
            $interval[] = [
                'date' => $value->format('Y-m-d'),
                'schedule_Id' => $schedule_id
            ];
        }
        //enter end date
        $interval[] = [
            'date' => $end,
            'schedule_Id' => $schedule_id
        ];

        return $interval;
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
        $reservations = DB::table('operation___detail__values')
        ->join('operation__detail_name', 'operation__detail_name.Detail_Id', '=', 'operation___detail__values.Detail_Id')
        ->join('operations', 'operations.Operation_Id', '=', 'operation___detail__values.Operation_Id')
        ->join('users', 'users.id', '=', 'operations.User_Id')
        ->select('operation___detail__values.*','operation__detail_name.Operation_Detail_Name','operations.Item_Id','users.First_Name', 'users.Middle_Name', 'users.Last_Name')
        ->where('operations.Item_Id','=',$id)
        ->get()
        ->groupBy('Operation_Id');

        $reservations = DB::table('operations')
        ->join('items', 'items.Item_Id', '=', 'operations.Item_Id')
        ->join('users', 'users.id', '=', 'operations.User_Id')
        ->join('operation___detail__values', 'operation___detail__values.Operation_Id', '=', 'operations.Operation_Id')
        ->select('operations.*','items.Item_Name','operation___detail__values.Operation_Detail_Value','users.First_Name', 'users.Middle_Name', 'users.Last_Name')
        ->where('operations.Item_Id','=',$id)
        // ->where('operation___detail__values.Detail_Id','=',2)//start date
        ->get();
        // ->groupBy('Operation_Id');

        return dd($reservations);


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