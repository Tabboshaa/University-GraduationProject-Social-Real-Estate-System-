<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Region;
use App\State;
use App\Street;
use Illuminate\Http\Request;

class RegionController extends Controller
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
        return view('website.backend.database pages.Add_Region',['counrty'=>$counrty,'state'=>$state,'city'=>$city]);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $region = Region::create([
            'Country_Id' => request('Country_Name'),
            'State_Id' => request('State_Name'),
            'City_Id' => request('City_Name'),
            'Region_Name' => request('Region_Name')
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
        $counrty=Country::all();
        $state=State::all();
        $city=City::all();
        $region=Region::all();
        return view('website.backend.database pages.Add_Region_Show',['counrty'=>$counrty,'state'=>$state,'city'=>$city,'region'=>$region]);
   
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
    public function destroy(Request $request,$id)
    {

        Region::destroy($request->id);

      
        return redirect()->route('region_show');
    }

    public function findstate(){

        //will get all states which her Country_Id is the ID we passed from $.ajax
        $state=State::all()->where('Country_Id','=',request('id'));
         
        // will send all values in state object by json
        return  response()->json($state);


    }

    public function findcity(){

        //will get all states which her Country_Id is the ID we passed from $.ajax
        $city=City::all()->where('State_Id','=',request('id'));
         
        // will send all values in state object by json
        return  response()->json($city);


    }

    public function findregion(){

        //will get all states which her Country_Id is the ID we passed from $.ajax
        $region=Region::all()->where('City_Id','=',request('id'));
         
        // will send all values in state object by json
        return  response()->json($region);


    }

    public function editRegion(Request $request)
    {
        //hygeb el country eli el ID bt3ha da 
        $region= Region::all()->find(request('id'));
        //hy7ot el name el gded f column el country name 
        $region->Region_Name=request('RegionName');
        $region->save();

        //hyb3t el update el gded fl country table 
        return response()->json($region);
    }
}
