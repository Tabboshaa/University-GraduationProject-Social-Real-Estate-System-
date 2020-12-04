<?php

namespace App\Http\Controllers;

use App\Street;
use App\City;
use App\Country;
use App\Region;
use App\State;
use Illuminate\Http\Request;

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
         $street = Street::create([
            'Country_Id' => request('Country_Name'),
            'State_Id' => request('State_Name'),
            'City_Id' => request('City_Name'),
            'Region_Id' => request('Region_Name'),
            'Street_Name' => request('Street_Name')
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
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $counrty=Country::all();
        $state=State::all();
        $city=City::all();
        $region=Region::all();
        $street=Street::all();
        return view('website.backend.database pages.Add_Street_Show',['counrty'=>$counrty,'state'=>$state,'city'=>$city,'region'=>$region,'street'=>$street]);
   
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
    public function destroy(Request $request,$id)
    {

        Street::destroy($request->id);

        $counrty=Country::all();
        $states=State::all();
        $city=City::all();
        $region=Region::all();
        $street=Street::all();
        return view('website\backend.database pages.Add_Street_Show',['state'=>$states,'country'=>$counrty,'city'=>$city , 'region'=>$region , 'street'=>$street]);
  
    }
    public function editStreet(Request $request)
    {
        //hygeb el country eli el ID bt3ha da 
        $street= Street::all()->find(request('id'));
        //hy7ot el name el gded f column el country name 
        $street->Street_Name=request('StreetName');
        $street->save();

        //hyb3t el update el gded fl country table 
        return response()->json($street);
    }
}
