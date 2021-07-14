<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Details;
use App\followeditemsbyuser;
use App\Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class OwnerController extends Controller
{
    //
    public function index()
    {  
        $user = Auth::user();
    
        // $item = DB::table('items')
        // ->join('cover__pages','items.Item_Id','cover__pages.Item_Id')
        // ->select('items.*','cover__pages.path')
        // ->where('items.User_ID','=',$User_Id )
        // ->get();

        $items = $user->items;  
        return view('website.FrontEnd.Owner.Show_Item', ['items' => $items]);
    }
    
    public function itemProfile($id = null)
    {
        //

        $state = StateController::getStates();
        $posts = PostsController::getItemPosts($id);
        $comments = CommentsController::getPostComments($id);
        $replies = CommentsController::getPostreplies($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $post_images = AttachmentController::getPostAttachments($id);
        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(6);
       
        $item = Item::find($id);

        $User = Auth::user();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User->id);

        return view(
            'website\frontend\owner\Item_Profile_Posts',
            [
                'User' => $User,
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

    public function itemDetails($id)
    {
        //

        $schedule = ScheduleController::getAvailableTime($id);
        // return $schedule;

        $state = StateController::getStates();

        $item = Item::find($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
      

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        $details = DB::table('details')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->join('datatypes', 'datatypes.id', '=', 'property__details.DataType_Id')
            ->select('details.*', 'sub__type__properties.Property_Name', 'property__details.Detail_Name', 'datatypes.datatype')
            ->get()->where('Item_Id', '=', $id)->groupBy(['Property_Name', 'Property_Id', 'Property_diff']);
            
            $Sub_Type_Id = Arr::get(Details::all()->where('Item_Id', '=', $id)->first(), 'Sub_Type_Id');
            
        return view('website\frontend\owner\Item_Profile_Details', ['details' => $details, 'states' => $state, 'item' => $item, 'cover' => $cover, 'schedule' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow,'subtype'=>$Sub_Type_Id]);
    }

    public function itemProfileGallery($id)
    {
        //
        $itemID = $id;
        $state = StateController::getStates();

        $item = Item::find($id);

        $gallery = DB::table('post_attachments')
            ->join('items', 'post_attachments.Item_Id', '=', 'items.Item_Id')
            ->join('attachments', 'attachments.Attachment_Id', '=', 'post_attachments.Attachment_Id')
            ->select('post_attachments.*', 'attachments.File_Path')->where('items.Item_Id', '=', $id)->paginate(8);

        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        return view('website\frontend\owner\Item_Profile_Gallery', ['item_id' => $itemID, 'states' => $state, 'item' => $item, 'cover' => $cover, 'gallery' => $gallery, 'check_follow' => $check_follow]);
    }

    public function itemProfileReviews($id = null)
    {
        //

        $state = StateController::getStates();
        $reviews = ReviewController::getItemReviews($id);
        $item = Item::find($id);
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
            ->select('operation___detail__values.*', 'operation__detail_name.Operation_Detail_Name', 'operations.Item_Id')
            ->where('operations.Item_Id', '=', $id)
            ->get()
            ->groupBy('Operation_Id');

        $reservations = DB::table('operations')
            ->join('items', 'items.Item_Id', '=', 'operations.Item_Id')
            ->join('users', 'users.id', '=', 'operations.User_Id')
            ->select('operations.*', 'items.Item_Name', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')
            ->where('operations.Item_Id', '=', $id)
            ->get();

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);
        $item = Item::find($id);
        // return dd($reservation_details);
        return view('website.frontend.owner.Item_Profile_Reservations', ['reservations' => $reservations, 'reservation_details' => $reservation_details, 'item' => $item, 'cover' => $cover, 'check_follow' => $check_follow]);
    }

    // function for page ownerManageSchedule
    public function itemManageSchedule($id = null)
    {

        $schedule = ScheduleController::getWholeSchedule($id);
        $item = Item::find($id);
        $cover = CoverPageController::getCoverPhotoOfItem($id);

        //schedule and location

        $User_Id = Auth::id();
        $check_follow = followeditemsbyuser::all()->where('Item_Id', '=', $id)->where('User_ID', '=', $User_Id);

        // return $schedule;
        return view('website\frontend\owner\Item_Profile_Manage_Schedule', ['item' => $item, 'cover' => $cover, 'schedules' => $schedule, 'item_id' => $id, 'check_follow' => $check_follow]);
    }
    
    public function getReservations(){
        $user = Auth::user();
        $items = $user->items;
// dd($items[0]->operations[0]->Operation_Id);
 return view('website.FrontEnd.Owner.Show_Reservations', ['items' => $items]);
    }

}
