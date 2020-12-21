<?php

namespace App\Http\Controllers;

use App\Country;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Countries=Country::all();
        return view('website.backend.database pages.Add_Country_Show',['C1'=>$Countries]);
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
        $country=Country::create([
            'Country_Name' => request('country_name'),
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
    public function destroy(Request $request)
    {
        // Will Destroy each column with id form action 
        Country::destroy($request->id);

        return redirect()->route('country_show');
    }
    //  function  EDIT: AJAX

    public function editCountry(Request $request)
    {
        //hygeb el country eli el ID bt3ha da 
        $country= Country::all()->find(request('id'));
        //hy7ot el name el gded f column el country name 
        $country->Country_Name=request('CountryName');
        $country->save();

        //hyb3t el update el gded fl country table 
        return response()->json($country);
    }
}
