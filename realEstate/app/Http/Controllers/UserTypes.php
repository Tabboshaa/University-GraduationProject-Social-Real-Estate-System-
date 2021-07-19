<?php

namespace App\Http\Controllers;

use App\User_Type;
use App\User;
use App\Type_Of_User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User_Type::all();

        //

        return view('website/backend.database pages.User_Type', ['user_typess' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
        DB::beginTransaction();
        try {
            $User_Type = User_Type::create([
                'Type_Name' => request('User_Type_Name')
            ]);
            DB::commit();
            return back()->with('success', 'Type Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
            return back()->withError($e->getMessage())->withInput();
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
    public function show()
    {
        //
        $user_types = User_Type::all();
        return view('website/backend.database pages.User_Type_Show', ['user_typess' => $user_types]);
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
        DB::beginTransaction();

        try {
            $user_type = User_Type::all()->find(request('id'));
            $user_type->Type_Name = request('UserTypeName');
            $user_type->save();

            DB::commit();
            return back()->with('info', 'Type Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function checkIfAdmin()
    {
        //
        $USER = Auth::user();
        $USER = $USER->usertype->groupBy('User_Type_ID');
        if (isset($USER[1])) //customer
        {
            return true;
        }
        return false;
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
        if (request()->has('id')) {
            DB::beginTransaction();

            try {
                User_Type::destroy(request('id'));
                DB::commit();
                return redirect()->route('usertype_show')->with('success', 'Type Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return redirect()->route('usertype_show')->with('error', 'Type cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('usertype_show')->with('warning', 'No type was chosen to be deleted.. !!');
    }


}
