<?php

namespace App\Http\Controllers;

use App\Type_Of_User;
use Illuminate\Http\Request;
use App\User;
use App\User_Type;
use App\Emails;
use App\Phone_Numbers;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

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
        $user_type = User_Type::all();
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
                    'password' => request('password'),
                    'National_ID' => request('national_id')
                ]);
                $user_id = Arr::get($user, 'id');

                $email = Emails::create([

                'User_ID' => $user_id,
                'email' => request('Email'),
                'Default' => 0
                ]);

                $phone_number = Phone_Numbers::create([

                'User_ID' => $user_id,
                'phone_number' => request('phone_number'),
                'Default' => 0
                 ]);

                 $user_type = Type_Of_User::create([
                    'User_ID' => $user_id,
                    'User_Type_ID' => request('select_type')
                    ]);
                
                

                //  $user_type = Type_Of_User::create([
                // 'User_ID' => $user_id,
                // 'User_Type_ID' => request('select_type')
                // ]);

            return back()->with('success', 'Item Created Successfully');
             } catch (\Illuminate\Database\QueryException $e) {
                 $errorCode = $e->errorInfo[1];
                 if ($errorCode == 1062) {
                     return back()->with('error', 'Already Exist !!');
                 }
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function destroy(Request $request,$id=null)
    {
        //
        User::destroy($request->id);
        Emails::destroy($request->id);
        Phone_Numbers::destroy($request->id);
        return redirect()->route('users_show/'.$id);
    }

    public function editUserName(Request $request)
    {
        $user= User::all()->find(request('id'));
        $user->First_Name=request('UserFirstName');
        $user->Middle_Name=request('UserMiddleName');
        $user->Last_Name=request('UserLastName');
        $user->save();

        return response()->json($user);
    }

    public function editUserEmail(Request $request)
    {
        $email= Emails::all()->find(request('id'));
        $email->email=request('email');
        $email->save();

        return response()->json($email);
    }

    public function editUserPhoneNumber(Request $request)
    {
        $phone_number= Phone_Numbers::all()->find(request('id'));
        $phone_number->phone_number=request('phonenumber');
        $phone_number->save();

        return response()->json($phone_number);
    }
}
