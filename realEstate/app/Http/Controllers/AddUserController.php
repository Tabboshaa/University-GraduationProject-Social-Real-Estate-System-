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

        // request()->validate([
        // 'image_user'=> 'image|mimes:jpeg,jpg,png',
        // 'user_type'=>['required'],
        // 'first_name'=>['required', 'string','max:225',"regex:'([A-Z][a-z]\s[A-Z][a-z])|([A-Z][a-z]*)'"],
        // 'middle_name'=>['required', 'string','max:225',"regex:'([A-Z][a-z]\s[A-Z][a-z])|([A-Z][a-z]*)'"],
        // 'last_name'=>['required', 'string','max:225',"regex:'([A-Z][a-z]\s[A-Z][a-z])|([A-Z][a-z]*)'"],
        // 'Email'=>['required', 'string','max:225',"regex:'\w+([-+.']\w+)@\w+([-.]\w+)\.\w+([-.]\w+)*'"],
        // 'password'=>['required', 'string','max:225',"regex:'\w{8,16}'"],
        // 'password_confirmation'=>['required', 'string','max:225',"regex:'\w{8,16}'"],
        // 'phone_number'=>['required', 'string','max:225',"regex:'[0][1][0-2][0-24-9]\s\d{7}'"],
        // 'birthdate'=>['required','date_format:D-M-Y|Y-M-D|before:today'],
        // 'national_id'=>'[2-3]\d{13}'
        // ]);
        if (($request->hasFile('image'))) {
                

            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('image', $filename, 'public');

            try {
              

                $user = User::create([
                    'Image'=>$filename,
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
    public function destroy($id)
    {
        //
    }
}
