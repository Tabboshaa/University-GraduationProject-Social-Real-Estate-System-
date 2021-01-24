<?php

namespace App\Http\Controllers;

use App\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //

    public function create($id=null)
    {

       $review=review::create([
           'Item_Id'=>$id,
           'User_Id'=>Auth::id(),
           'Review_Title'=>'ay7aga',
           'Review_Content'=>request('review_content'),
           'Number_Of_Stars'=>request('stars')
       ]);
       return response()->json("ddd");

    }
    public static function getItemReviews($item_id)
    {
        //
        $review=DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.User_Id')
            ->select('reviews.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->paginate(10);


        return $review;
    }
}
