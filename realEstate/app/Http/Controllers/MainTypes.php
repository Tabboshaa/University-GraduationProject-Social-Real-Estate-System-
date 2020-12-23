<?php

namespace App\Http\Controllers;

use App\Main_Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class MainTypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website.backend.database pages.Main_Types');
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
            $Main_Type = Main_Type::create([
                'Main_Type_Name' => request('Main_Type_Name'),
            ]);
            return back()->with('success','Item Created Successfully');
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with('error','Already Exist !!');
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
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Main_Types_Show',['main_type'=>$main_types]);
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
            $main_types=Main_Type::all()->find(request('id'));
            $main_types->Main_Type_Name=request('MainTypeName');
            $main_types->save();

                return back()->with('info','Item Edited Successfully');
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error','Error editing item');
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
    public function destroy(Request $request)
    {
        try {
        Main_Type::destroy($request->mainType);
        return redirect()->route('main_types_show')->with('success', 'Item Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        return redirect()->route('main_types_show')->with('error', 'Item cannot be deleted');
                
    }
}
}
