<?php

namespace App\Http\Controllers;

use App\Type_Of_User;
use Illuminate\Http\Request;
use App\User;
use App\User_Type;
use App\Emails;
use App\Phone_Numbers;
use App\followeditemsbyuser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_type = User_Type::paginate(10);
        return view('website\backend.database pages.Add_User', ['user_type' => $user_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        try {
                $user = User::create([
                    'First_Name' => request('first_name'),
                    'Middle_Name' => request('middle-name'),
                    'Last_Name' => request('last-name'),
                    'Birth_Day' => request('birthdate'),
                    'Gender' => request('gender'),
                    'password' => Hash::make( request('password')),
                ]);

                $user_id = Arr::get($user, 'id');

                $email = Emails::create([
                'User_ID' => $user_id,
                'email' => request('Email'),
                'Default' => 1
                ]);

                $phone_number = Phone_Numbers::create([
                'User_ID' => $user_id,
                'phone_number' => request('phone_number'),
                'Default' => 1
                 ]);

                $user_type = Type_Of_User::create([
                'User_ID' => $user_id,
                'User_Type_ID' => request('select_type')
                ]);


                return back()->with('success', 'Item Created Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Already Exist !!');
                }
           }


    }

    public function BeOwner($user_id)
    {
        $user = User::all()->find($user_id);

        $user->First_Name=request('First');
        $user->Middle_Name=request('Middle');
        $user->Last_Name=request('Last');
        $user->National_ID=request('National');
        $user->save();

        $phone_number = Phone_Numbers::all()->where('User_ID','=',$user->id);

        if($phone_number=='[]')
        {

            $phone_number = Phone_Numbers::create([
                'User_ID' => $user_id,
                'phone_number' => request('Phone'),
                'Default' => 1
            ]);
        }
        else
        {
            $phone_number->phone_number=request('Phone');
        }
        $typeOfUser=Type_Of_User::create([
            'User_ID' =>$user_id,
             'User_Type_ID'=>3
         ]);
        return view('website.frontend.Owner.Add_Item');
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
    public function show($id)
    {
        //
        $user = User::all()->where('id','=',$id)->first();
        $posts= PostsController::userPosts($id);
        $profile_photo=ProfilePhotoController::getPhoto($id);
        $cover_photo=CoverPhotoController::getPhoto($id);
        $post_images = AttachmentController::getAttachmentsOfPosts($id);

        $post_images = [];

        foreach ($posts as $post)
        {
            $post_image = AttachmentController::getAttachmentsOfPosts($post->Post_Id);

            $post_images=collect($post_images)->merge($post_image);

        }

        $post_images= $post_images->groupby('Post_Id');

        if($id == Auth::id())
        {
            return view('website\frontend\customer\Customer_Own_Profile',['First_Name'=>$user->First_Name,'Middle_Name'=>$user->Middle_Name,'Last_Name'=>$user->Last_Name,'Cover_Photo'=>$cover_photo,'Profile_Photo'=>$profile_photo,'posts'=>$posts,'post_images'=>$post_images]);

        }

        return view('website\frontend\customer\Customer_Profile',['First_Name'=>$user->First_Name,'Middle_Name'=>$user->Middle_Name,'Last_Name'=>$user->Last_Name,'Cover_Photo'=>$cover_photo,'Profile_Photo'=>$profile_photo,'posts'=>$posts,'post_images'=>$post_images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getItemWithOwnerName($item_id)
    {
        //
        $item = DB::table('items')
        ->join('users', 'users.id', '=', 'items.User_Id')
        ->select('items.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')->where('Item_Id', '=', $item_id)->first();
return $item;
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
    public function search()
    {
          $search = request('email');

        $email=Emails::where('email', 'LIKE', '%'.$search.'%')->get();

        return response()->json($email);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id=null)
    {
        //

        try {
        User::destroy($request->id);
        Emails::destroy($request->id);
        Phone_Numbers::destroy($request->id);
        return back()->with('success', 'Item Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return back()->with('error', 'Item cannot be deleted');

    }
    }

    public function editUserName(Request $request)
    {
        try {
        $user= User::all()->find(request('id'));
        $user->First_Name=request('UserFirstName');
        $user->Middle_Name=request('UserMiddleName');
        $user->Last_Name=request('UserLastName');
        $user->save();
        return back()->with('info','Item Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Already Exist !!');
        }
    }
    }

    public function editUserEmail(Request $request)
    {
        try {
        $email= Emails::all()->find(request('id'));
        $email->email=request('email');
        $email->save();
        return back()->with('info','Item Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
             return back()->with('error', 'Already Exist !!');
        }
    }
    }

    public function editUserPhoneNumber(Request $request)
    {
        try {
        $phone_number= Phone_Numbers::all()->find(request('id'));
        $phone_number->phone_number=request('phonenumber');
        $phone_number->save();
        return back()->with('info','Item Edited Successfully');
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                     return back()->with('error', 'Already Exist !!');
                }
            }
    }
    public static function getUserName($user_id)
    {
        //

        $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=',$user_id )->get()->first();

        return $user;
    }
    public static function FollowedItem ($Item_Id)
    {
        $followed_items = followeditemsbyuser :: create([
            'Item_Id' => $Item_Id,
            'User_ID'=>Auth::id()
        ]);
        $followed_items->save();
        return back();
    }
    public static function UnfollowItem ($Item_Id)
    {
        $User_Id = Auth::id();
        // DB::table('followeditemsbyusers')->where('User_ID','=',$User_Id,'Item_Id','=',$Item_Id)->delete();

        $followed_items=followeditemsbyuser::all()->where('Item_Id','=',$Item_Id)->where('User_ID','=',$User_Id);

        followeditemsbyuser::destroy($followed_items[2]->Followed_Item_Id);
         return back();

    }
}

