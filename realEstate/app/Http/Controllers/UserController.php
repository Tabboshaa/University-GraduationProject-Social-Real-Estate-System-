<?php

namespace App\Http\Controllers;

use App\ProfilePhoto;
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
use App\Country;
// use Auth;/
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        //
        $user_type = User_Type::paginate(10);
        return view('website\backend.database pages.Add_User', ['user_type' => $user_type]);
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
    public function create(Request $request)
    {
        //
        DB::beginTransaction();
        try {
            $user = User::create([
                'First_Name' => request('first_name'),
                'Middle_Name' => request('middle-name'),
                'Last_Name' => request('last-name'),
                'Birth_Day' => request('birthdate'),
                'Gender' => request('gender'),
                'password' => Hash::make(request('password')),
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


            DB::commit();
            return back()->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }

    public function AdminProfile()
    {
        try{
        $User_ID = Auth::id();
        $user = User::all()->where('id', '=', $User_ID)->first();
        $email = Emails::all()->where('User_ID', '=', $User_ID)->first();
        $phone = Phone_Numbers::all()->where('User_ID', '=', $User_ID)->first();
        return view('website.backend.database pages.Admin_profile', ['user' => $user, 'email' => $email, 'phone' => $phone]);
    }

    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }}

    public function EditUserProfileVeiw()
    {
        try{
        $User_ID = Auth::id();
        $user = User::all()->where('id', '=', $User_ID)->first();

        $email = Emails::all()->where('User_ID', '=', $User_ID)->first();
        $phone = Phone_Numbers::all()->where('User_ID', '=', $User_ID)->first();
        $image = ProfilePhoto::all()->where('User_Id', '=', $User_ID)->first();

        return view('website.frontend.customer.EditUserProfile', ['user' => $user, 'email' => $email, 'phone' => $phone, 'image' => $image]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public function EditUserProfile()
    {
        DB::beginTransaction();
        try {
            $User_ID = Auth::id();
            $user = User::all()->find($User_ID);
            $email = Emails::all()->where('User_ID', '=', $User_ID)->first();
            $phone = Phone_Numbers::all()->where('User_ID', '=', $User_ID)->first();
            $image = ProfilePhoto::all()->where('User_ID', '=', $User_ID)->first();
if(request()->has('email')){
            $email->email = request('email');
            $email->save();}
if(request()->has('phone')){
            $phone->phone_number = request('phone');
            $phone->save();}
if(request()->has('Fname')){
            $user->First_Name = request('Fname');
}
if(request()->has('Mname')){
            $user->Middle_Name = request('Mname');
}
if(request()->has('Lname')){
            $user->Last_Name = request('Lname');
}
if(request()->has('birthdate')){
            $user->Birth_Day =  request('birthdate');
            // $user->Gender = request('');
}
if(request()->has('nationalid')){
            $user->National_ID = request('nationalid');
}
            $user->save();

            DB::commit();
            return back()->with('success', 'User Edited Succesfully');
        } catch (\Exception $e)
        {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'user Already Exist !!');
            }
            if ($errorCode == 1048) {
                return back()->with('error', 'You must select all values!!');
            } else {
                return $e->errorInfo;
            }
        }
    }

    public function checkIfOwner()
    {
        try{
        $user_id = Auth::id();
        $user= Type_Of_User::all()->where('User_ID', '=', $user_id)->where('User_Type_ID', '=', 3)->first();

        return  $user;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public function BeOwner($toYourProperties = null)
    {
//        dd($toYourProperties,\request()->all());

//        try {
            $countries = Country::all();
            //all done mean that function called from light modal ->that mean want to be owner and all its information is here
            if (\request('allDone')) {

                $typeOfUser = Type_Of_User::create([
                    'User_ID' => Auth::id(),
                    'User_Type_ID' => 3
                ]);
                return view('website.frontend.Owner.Add_Item', ['country' => $countries]);
            }

            //means that you are come from list your properties our add property
            if ($toYourProperties != null) {
                return view('website.frontend.Owner.Add_Item', ['country' => $countries]);
            } else {
                $user =Auth::user();

                if (request('First') != null)
                    $user->First_Name = request('First');
                if (request('Middle') != null)
                    $user->Middle_Name = request('Middle');
                if (request('Last') != null)
                    $user->Last_Name = request('Last');
                if (request('National') != null)
                    $user->National_ID = request('National');
                $user->save();


                $phone_number = Phone_Numbers::all()->where('User_ID', '=', $user->id);


                if ($phone_number == '[]') {

                    $phone_number = Phone_Numbers::create([
                        'User_ID' => Auth::id(),
                        'phone_number' => request('Phone'),
                        'Default' => 1
                    ]);
                } else {
                    $phone_number->phone_number = request('Phone');
                }

                //check if owner means that you are allerady owner but your data is deleted //
                if (\request('Just')==null) {
                    $typeOfUser = Type_Of_User::create([
                        'User_ID' => Auth::id(),
                        'User_Type_ID' => 3
                    ]);
                    return view('website.frontend.Owner.Add_Item', ['country' => $countries]);
                }else{return redirect()->back();}

            }
//        } catch (\Exception $e) {
//            DB::rollBack();
//            $errorCode = $e->errorInfo[1];
//            if ($errorCode == 1062) {
//                return back()->with('error', 'City Already Exist !!');
//            }
//            if ($errorCode == 1048) {
//                return back()->with('error', 'You must select all values!!');
//            } else {
//                return $e->errorInfo;
//            }
//        }
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



    //route byro7 3la index aw function show da bst5dmo lma ha show variables
    //fe el blade in the same time the route passes me to the blade
    public function showMyProfile()
    {
        try{
        $user = User::all()->where('id', '=', Auth::id())->first();

        $posts = PostsController::userPosts(Auth::id());
        $profile_photo = ProfilePhotoController::getPhoto(Auth::id());
        $cover_photo = CoverPhotoController::getPhoto(Auth::id());
        $post_images = AttachmentController::getPostAttachments(Auth::id());
        $gallery = AttachmentController::getAttachmentsOfuser(Auth::id());
        $post_images = [];

        foreach ($posts as $post) {
            $post_image = AttachmentController::getAttachmentsOfPosts($post->Post_Id);

            $post_images = collect($post_images)->merge($post_image);
        }

        if ($post_images != null) {
            $post_images = $post_images->groupby('Post_Id');
        }

        $User = Auth::user();

        // commented for test only

        return view('website\frontend\customer\Customer_Own_Profile', [
            'id' =>  Auth::id(),
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
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
        try{
        $search = request('email');

        $email = Emails::where('email', 'LIKE', '%' . $search . '%')->get();

        return response()->json($email);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        //
        DB::beginTransaction();

        try {
            User::destroy($request->id);
            Emails::destroy($request->id);
            Phone_Numbers::destroy($request->id);
            DB::commit();
            return back()->with('success', 'Item Deleted Successfully');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Item cannot be deleted');
        }
    }

    public function editUserName()
    {
        DB::beginTransaction();

        try {
            $user = User::all()->find(request('id'));
            $user->First_Name = request('UserFirstName');
            $user->Middle_Name = request('UserMiddleName');
            $user->Last_Name = request('UserLastName');
            $user->save();
            DB::commit();
            return back()->with('info', 'Item Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
        return back()->withError($e->getMessage())->withInput();
    }

    public function editUserEmail(Request $request)
    {
        DB::beginTransaction();

        try {
            $email = Emails::all()->find(request('id'));
            $email->email = request('email');
            $email->save();
            DB::commit();
            return back()->with('info', 'Email Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
        return back()->withError($e->getMessage())->withInput();
    }

    public function editUserPhoneNumber(Request $request)
    {
        try {
            $phone_number = Phone_Numbers::all()->find(request('id'));
            $phone_number->phone_number = request('phonenumber');
            $phone_number->save();
            return back()->with('info', 'Item Edited Successfully');
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }
    public static function getUserName($user_id)
    {
        //
try{
        $user = User::select('First_Name', 'Middle_Name', 'Last_Name')->where('id', '=', $user_id)->get()->first();

        return $user;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public static function FollowedItem($Item_Id)
    {
        DB::beginTransaction();
        try {
            $followed_items = followeditemsbyuser::create([
                'Item_Id' => $Item_Id,
                'User_ID' => Auth::id()
            ]);
            $followed_items->save();

            $to_user = ItemController::getowner($Item_Id);
            NotificationController::createRedirect(Auth::id(), $to_user,  'Started Following your item', '/view_User/' . Auth::id());
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }
    public static function UnfollowItem($Item_Id)
    {
        $User_Id = Auth::id();
        $followed_items = followeditemsbyuser::all()->where('Item_Id', '=', $Item_Id)->where('User_ID', '=', $User_Id)->first();
        DB::beginTransaction();

        try {
            followeditemsbyuser::destroy($followed_items->Followed_Item_Id);
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function get_user_types()
    {
        //
        try{
        $user_types = User_Type::all();
        $Users = User::all();
        return view('website/backend.database pages.Users_Show', ['user_typess' => $user_types, 'users' => $Users]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function getUser($id = null)
    {
        try{
        if ($id == null && request()->has('id')) $id = request('id');
        //$Type_Of_User=Type_Of_User::all();
        $user_types = User_Type::all();
        $Users = DB::table('type__of__users')->join('users', 'users.id', '=', 'type__of__users.User_ID')
            ->join('emails', 'type__of__users.User_ID', '=', 'emails.User_ID')
            ->join('phone__numbers', 'type__of__users.User_ID', '=', 'phone__numbers.User_ID')
            ->select('users.*', 'type__of__users.*', 'emails.*', 'phone__numbers.*', 'users.First_Name', 'users.Middle_Name', 'users.Last_Name')
            ->where('User_Type_ID', '=', $id)->get();


        return  response()->json($Users);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public function changePassword()
    {


        try {
            $User_ID = Auth::id();
            $user = User::all()->find($User_ID);
            $password = request('password');

            if (Hash::check($password, $user->password)) {
                if ((\request('newpassword')) != \request('confirm')) return 0;
                $user->password = Hash::make(request('newpassword'));
                $user->save();
                return 1;


            } else
                return 2;

        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }
        public function Adminlogout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('AdminLogin');


    }
}
