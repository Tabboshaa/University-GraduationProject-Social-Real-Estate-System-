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
        $Main_Type = Main_Type::create([
            'Main_Type_Name' => request('Main_Type_Name'),
        ]);
        return view('website.backend.database pages.Main_Types');
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
        $main_types=Main_Type::all()->find(request('id'));
        $main_types->Main_Type_Name=request('MainTypeName');
        $main_types->save();

        return response()->json($main_types);
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
        //return dd($request->all());
        //
        Main_Type::destroy($request->mainType);

        $main_types=Main_Type::all();
        
        return redirect()->route('main_types_show');
}
}