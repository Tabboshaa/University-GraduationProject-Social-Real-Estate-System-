<?php

namespace App\Http\Controllers;

use App\User_Type;
use App\User;
use App\Type_Of_User;
use Illuminate\Support\Facades\DB;
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
        $users = DB::table('users')->paginate(2);

        //

        return view('website/backend.database pages.User_Type', ['user_type' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try {
            $User_Type = User_Type::create([
                'Type_Name' => request('User_Type_Name')
            ]);
            return back()->with('success', 'Type Created Successfully');
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
    public function show()
    {
        //
        $user_types = User_Type::all();
        return view('website/backend.database pages.User_Type_Show', ['user_type' => $user_types]);
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
        try {

        $user_type = User_Type::all()->find(request('id'));
        $user_type->Type_Name = request('UserTypeName');
        $user_type->save();

        return back()->with('info','Type Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Already Exist !!');
        }
    }
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
        if(request()->has('id'))
       {   
        try {
        User_Type::destroy(request('id'));
        return redirect()->route('usertype_show')->with('success', 'Type Deleted Successfully');
            }catch (\Illuminate\Database\QueryException $e){
        return redirect()->route('usertype_show')->with('error', 'Type cannot be deleted');
    }
}else return redirect()->route('usertype_show')->with('warning', 'No type was chosen to be deleted.. !!');
    }

    public function get_user_types()
    {
        //
        $user_types = User_Type::all();
        $Users=User_Type::all();
        return view('website/backend.database pages.Users_Show', ['user_types' => $user_types,'users'=>$Users]);

    }
    public function getUser($id=null)
    {
        if($id==null && request()->has('id')) $id=request('id');
         //$Type_Of_User=Type_Of_User::all();
         $user_types = User_Type::all();
         $Users=DB::table('type__of__users')->join('users','users.id','=','type__of__users.User_ID')
         ->join('emails', 'type__of__users.User_ID', '=', 'emails.User_ID')
         ->join('phone__numbers', 'type__of__users.User_ID', '=', 'phone__numbers.User_ID')
         ->select('users.*','type__of__users.*','emails.*','phone__numbers.*','users.First_Name','users.Middle_Name','users.Last_Name')
         ->get()->where('User_Type_ID', '=', $id);


         return  response()->json($Users);


    }
}
