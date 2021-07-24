<?php

namespace App\Http\Controllers;

use App\Type_Of_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeOfUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public static function checkIfAdmin()
    {
        //
        try{
        $USER = Auth::user();
        $USER = $USER->usertype->groupBy('User_Type_ID');
        if (isset($USER[1])) //customer
        {
            return true;
        }
        return false;
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
     * @param  \App\Type_Of_User  $type_Of_User
     * @return \Illuminate\Http\Response
     */
    public function show(Type_Of_User $type_Of_User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_Of_User  $type_Of_User
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_Of_User $type_Of_User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_Of_User  $type_Of_User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_Of_User $type_Of_User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_Of_User  $type_Of_User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_Of_User $type_Of_User)
    {
        //
    }
}
