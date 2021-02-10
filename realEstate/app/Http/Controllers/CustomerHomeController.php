<?php

namespace App\Http\Controllers;

use App\Cover_Page;
use App\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Arr;

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
        return view("website.frontend.customer.CustomerHome", ['states' => $state]);
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




        return view(
            'website\frontend\customer\Item_Profile_Posts',
            [
                'states' => $state,
                'posts' => $posts,
                'item' => $item,
                'cover' => $cover,
                'post_images' => $post_images,
                'comments' => $comments,
                'replies' => $replies
            ]
        );
    }

    public function itemDetails($id)
    {
        //
        $schedule = $this->getAvailableTime($id);
return $schedule;

        //        return Carbon::parse($test)->format('d');

        $state = StateController::getStates();

        $item = DB::table('items')
            ->join('users', 'users.id', '=', 'items.User_Id')
            ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $id)->first();

        $cover = Cover_Page::all()->where('Item_Id', '=', $id)->first();
        //schedule and location

        return view('website\frontend\customer\Item_Profile_Details', ['states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule]);
    }

    public function getAvailableTime($item_id)
    {
        //     get from Schedule endDate startDate where item id =$item_id
        //
        $schedule = schedule::all()->where('Item_Id', '=', $item_id);
        $days=[];
        //get day od every schedule
        foreach ($schedule as $value) {

            $day=$this->getdays($value->Start_Date,$value->End_Date);
            //merge days
            $days=collect($days)->merge($day)->unique(); //unique 3shan mykrrsh date mrten
        }

//group by month of date
        $days = collect($days)->groupBy(function ($val) {
            return Carbon::parse($val['date'])->format('m');
        })->toArray();


        return $days;
    }
    function getdays($start,$end)
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
        ];
        //for loop to store interval in array
        foreach ($period as $key => $value) {
            $interval[] = [
                'date' => $value->format('Y-m-d'),
            ];
        }
        //enter end date
        $interval[] = [
            'date' => $end,
        ];

        //group by month of date
        // $interval = collect($interval)->groupBy(function ($val) {
        //     return Carbon::parse($val['date'])->format('m');
        // })->toArray();

        return $interval;
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


}
