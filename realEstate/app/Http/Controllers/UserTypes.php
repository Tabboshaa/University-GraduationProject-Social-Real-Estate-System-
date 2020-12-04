<?php

namespace App\Http\Controllers;

use App\User_Type;
use Illuminate\Http\Request;

class UserTypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website/backend.database pages.User_Type');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $User_Type = User_Type::create([
            'Type_Name' => request('User_Type_Name')
        ]);
     return $this->index();
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
    public function show()
    {
        //
        $user_types=User_Type::all();
        return view('website/backend.database pages.User_Type_Show',['user_type'=>$user_types]);
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
        $user_type=User_Type::all()->find(request('id'));
        $user_type->Type_Name=request('UserTypeName');
        $user_type->save();

        return response()->jason($user_type);
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
    public function destroy()
    {
        //

        User_Type::destroy(request('id'));

        $user_types=User_Type::all();
        return view('website/backend.database pages.User_Type',['user_type'=>$user_types]);
  
    }
}
