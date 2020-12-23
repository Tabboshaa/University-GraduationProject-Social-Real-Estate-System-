<?php

namespace App\Http\Controllers;

use App\Street;
use App\City;
use App\Country;
use App\Region;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $counrty=Country::all();
        $state=State::all();
        $city=City::all();
        $region=Region::all();
        $street=Street::all();
        return view('website.backend.database pages.Add_Street',['counrty'=>$counrty,'state'=>$state,'city'=>$city,'region'=>$region , 'street'=>$street]);
   
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
         $street = Street::create([
            'Country_Id' => request('Country_Name'),
            'State_Id' => request('State_Name'),
            'City_Id' => request('City_Name'),
            'Region_Id' => request('Region_Name'),
            'Street_Name' => request('Street_Name')
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
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
   
        $region=Region::all();
        $city=City::all();
        $states=State::all();
        $countries=Country::all();
        $streets=DB::table('streets')
        ->join('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
        ->join('states', 'streets.State_Id', '=', 'states.State_Id')
        ->join('cities', 'streets.City_Id', '=', 'cities.City_Id')
        ->join('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
        ->select('streets.*', 'countries.Country_Name','states.State_Name','cities.City_Name','regions.Region_Name')->get();
        //el subtype name w el main type name 
        return view('website.backend.database pages.Add_Street_Show',['counrty'=>$countries,'state'=>$states,'city'=>$city,'region'=>$region,'street'=>$streets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Street $street)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id=null)
    {
        try {
       
        Street::destroy($request->id);
        return redirect()->route('street_show')->with('success', 'Item Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return redirect()->route('street_show')->with('error', 'Item cannot be deleted');
                
    }
    }
    public function editStreet(Request $request)
    {
        try {
        //hygeb el country eli el ID bt3ha da 
        $street= Street::all()->find(request('id'));
        //hy7ot el name el gded f column el country name 
        $street->Street_Name=request('StreetName');
        $street->save();

        //hyb3t el update el gded fl country table 
        return back()->with('info','Item Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Error editing item');
        }
    }
    }
}
