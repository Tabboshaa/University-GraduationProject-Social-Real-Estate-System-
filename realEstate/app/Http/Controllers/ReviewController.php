<?php

namespace App\Http\Controllers;

use App\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    public function index($id = null)
    {
        //

        $reviews = ReviewController::getItemReviews($id);

        return view('website\backend\database pages\Item_Reviews', ['reviews' => $reviews,'Item_Id'=> $id]);
    }

    public function create()
    {

        $AuthReview=review::all()->where('Item_Id','=',request('id'))->where('User_Id','=',Auth::id())->first();

        if($AuthReview){
            $AuthReview->Review_Content=request('review_content');
            $AuthReview->Number_Of_Stars=request('stars');
            $AuthReview->save();
        }else{
            $review=review::create([
                'Item_Id'=>request('id'),
                'User_Id'=>Auth::id(),
                'Review_Title'=>' ',
                'Review_Content'=>request('review_content'),
                'Number_Of_Stars'=>request('stars')
            ]);
        }

       return response()->json("done");

    }
    public static function getItemReviews($item_id)
    {
        //
        $review=DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.User_Id')
            ->where('reviews.Item_Id','=',$item_id)
            ->select('reviews.*', 'users.First_Name','users.Middle_Name','users.Last_Name')->paginate(10);


        return $review;
    }

    public static function getItemRate($item_id)
    {
        //
        $review= review::all()->where('Item_Id','=',$item_id)->sum('Number_Of_Stars');
        $count= review::all()->where('Item_Id','=',$item_id)->count();

        if($count != 0)
        return ($review/$count);

        return 0;
    }

    public function destroy($id)
    {
        //
         try {
         review::destroy($id);
         return  redirect()->back()->with('success', 'Review Deleted Successfully');
     }catch (\Illuminate\Database\QueryException $e){

         return redirect()->back()->with('error', 'Review cannot be deleted');

     }

    }



}
