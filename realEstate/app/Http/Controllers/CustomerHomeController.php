<?php

namespace App\Http\Controllers;


use App\User;
use App\Item;
use App\schedule;
use App\CoverPhoto;
use App\ProfilePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\followeditemsbyuser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use App\comments;
use App\posts;
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
        $cover =CoverPageController::getCoverPhotoOfItem($id);
        $post_images = AttachmentController::getPostAttachments($id);
        $item =AddUserController::getItemWithOwnerName($id);

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

        $schedule = $this->getAvailableTime($id);
        // return $schedule;

        $state = StateController::getStates();

        $item =AddUserController::getItemWithOwnerName($id);
        $cover =CoverPageController::getCoverPhotoOfItem($id);
        //schedule and location

        $User_Id = Auth::id();
        $check_follow=followeditemsbyuser::all()->where('Item_Id','=',$id)->where('User_ID','=',$User_Id);


        return view('website\frontend\customer\Item_Profile_Details', ['states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule,'item_id'=>$id,'check_follow'=>$check_follow]);
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
        foreach ($period as $key => $value)
        {
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

        $item =AddUserController::getItemWithOwnerName($id);

        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(8);

        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $User_Id = Auth::id();
        $check_follow=followeditemsbyuser::all()->where('Item_Id','=',$id)->where('User_ID','=',$User_Id);

        return view('website\frontend\customer\Item_Profile_Gallery', ['states' => $state, 'item' => $item, 'cover' => $cover, 'gallery' => $gallery,'check_follow'=>$check_follow]);
    }
    public function itemProfileReviews($id = null)
    {
        //

        $state = StateController::getStates();
        $reviews = ReviewController::getItemReviews($id);
        $item =AddUserController::getItemWithOwnerName($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);

        $User_Id = Auth::id();
        $check_follow=followeditemsbyuser::all()->where('Item_Id','=',$id)->where('User_ID','=',$User_Id);

        return view('website\frontend\customer\Item_Profile_Reviews', ['states' => $state, 'reviews' => $reviews, 'item' => $item, 'cover' => $cover,'check_follow'=>$check_follow]);
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
        
        
        $user = User :: all()->where ('id','=',$User_Id);
        
        $posts = DB::table('followeditemsbyusers')
        ->join('posts','followeditemsbyusers.Item_Id','posts.Item_Id')
        ->join('items','followeditemsbyusers.Item_Id','items.Item_Id')
        ->select('posts.*','items.Item_Name')
        ->where('followeditemsbyusers.User_ID','=',$User_Id )
        ->get();
        
        

        $cover__pages = DB::table('cover__pages')
        ->join('items','items.Item_Id','cover__pages.Item_Id')
        ->select('cover__pages.path')
        ->get();

        $items = item::all();

        $post_images = DB::table('post_attachments')
        ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id') 
        ->join('followeditemsbyusers','followeditemsbyusers.Item_Id','post_attachments.Item_Id')
        ->select('post_attachments.*', 'attachments.File_Path')
        ->get()
        ->groupBy('Post_Id');

        $comments = [];
        $replies = [];
        
        if($posts!=null){
        foreach ($posts as $post)
        {
            $comment = CommentsController::getPostCommentsHomePage($post->Post_Id);
           
            $comments=collect($comments)->merge($comment);
           

            $reply = CommentsController::getPostrepliesHomePage($post->Post_Id);
            $replies=collect($replies)->merge($reply);
        }
    }

        $comments= $comments->groupBy('Post_Id');
        $replies= $replies->groupby('Parent_Comment');  
        // return $replies;
        
        $check_follow=followeditemsbyuser::all()->where('User_ID','=',$User_Id);
        
        return view("website.frontend.customer.HomePagePosts",
        [
            'posts'=>$posts ,
            'user'=>$user,
            'items'=>$items,
            'post_images'=>$post_images ,
            'comments'=>$comments,
            'replies'=>$replies,
            'cover__pages'=>$cover__pages,
            '$check_follow'=>$check_follow,
            'User_Id'=>$User_Id
        ]);

    }
    public function DestroyComment(Request $request, $id=null)
    {
     
    
            comments::destroy($request->id);
         return redirect()->route('HomePage')->with('success', 'Comment Deleted Successfully');
    
 
 }
 public function editComment()
 {
     
    
     try {
       
         $comment = comments::all()->find(request('id'));
         $comment-> Comment = request('edit_Comment');
         $comment->save();
    
         return back()->with('info', 'Comment Edited Successfully');
     } catch (\Illuminate\Database\QueryException $e) {
         $errorCode = $e->errorInfo[1];
         if ($errorCode == 1062) {
             return back()->with('error', 'Error editing item');
         }
     }
 }
 public function DestroyPost(Request $request, $id=null)
 {
  
 
         posts::destroy($request->id);
      return redirect()->route('HomePage')->with('success', 'Post Deleted Successfully');
 

}
public function editPost()
 {
     
    
     try {
       
         $post = posts::all()->find(request('id'));
         $post-> Post_Content = request('edit_Post');
         $post->save();
    
         return back()->with('info', 'post Edited Successfully');
     } catch (\Illuminate\Database\QueryException $e) {
         $errorCode = $e->errorInfo[1];
         if ($errorCode == 1062) {
             return back()->with('error', 'Error editing item');
         }
     }
 }

    //route byro7 3la index aw function show da bst5dmo lma ha show variables
    //fe el blade in the same time the route passes me to the blade 
    public function showMyProfile ()
    {
        $User_Id = Auth::id();
        $User = User::all()->where ('id','=',$User_Id)->first();
        $Cover_Photo = CoverPhotoController::getPhoto($User_Id); 
        $Profile_Photo = ProfilePhotoController::getPhoto($User_Id);
        $posts = PostsController::userPosts($User_Id);

        $comments = [];
        $replies = [];
        foreach ($posts as $post)
        {
            $comment = CommentsController::getPostCommentsHomePage($post->Post_Id);
           
            $comments=collect($comments)->merge($comment);
           

            $reply = CommentsController::getPostrepliesHomePage($post->Post_Id);
            $replies=collect($replies)->merge($reply);
        }

        $comments= $comments->groupby('Post_Id');
        $replies= $replies->groupby('Parent_Comment');
        
        
        return view("website.frontend.customer.Customer_Own_Profile",
        ['User' => $User ,
         'Cover_Photo' => $Cover_Photo , 'Profile_Photo' => $Profile_Photo,
         'posts' => $posts , 'comments' => $comments , 'replies' => $replies ]);
    }
}

