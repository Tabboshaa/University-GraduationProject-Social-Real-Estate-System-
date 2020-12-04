<?php

namespace App\Http\Controllers;

use App\Type_Of_User;
use Illuminate\Http\Request;
use App\User;
use App\User_Type;
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
        $user_type=User_Type::all();
        return view ('website\backend.database pages.Add_User',['user_type'=>$user_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        if(($request->hasFile('image')))
        {


            $filename=$request->image->getClientOriginalName();
            $request->image->storeAs('image',$filename,'public');

            $user=User::create([

                'Image'=>$filename,
                'First_Name'=> request('first_name'),
                'Middle_Name'=> request('middle-name'),
                'Last_Name'=>request('last-name'),
                'Email'=>request('Email'),
                'Birth_Day'=>request('birthdate'),
                'Gender'=>request('gender'),
                'password'=>request('pasword'),
                'National_ID'=>request('national_id')
                ]);
                $user_id=Arr::get($user,'id');
                $user_type=Type_Of_User::create([
                    'User_ID' => $user_id,
                    'User_Type_ID'=> request('select_type')
                ]);

        }


            return redirect()->back();
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
