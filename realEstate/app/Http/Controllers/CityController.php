<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\State;
use App\Street;
use App\Region;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $city=City::all();
        $countries=Country::all();
        $states=State::all();
        return view('website\backend.database pages.Add_City',['country'=>$countries , 'state'=>$states , 'city'=>$city]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        request()->validate([
            'country_name' => ['required', 'string','max:225',"regex:'[A-Z][a-z]* [A-Z][a-z]*'"],
            'State_Name' => ['required', 'string','max:225',"regex:'[A-Z][a-z]* [A-Z][a-z]*'"],
            'City_Name' => ['required', 'string','max:225',"regex:'[A-Z][a-z]* [A-Z][a-z]*'"]
        ]);

        try {
        $city=City::create([
            'City_Name' => request('City_Name'),
            'Country_Id'=> request('Country_Name'),
            'State_Id'  => request('State_Name')
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
        $states=State::all();
        $countries=Country::all();
        $cities=DB::table('cities')
        ->join('countries', 'cities.Country_Id', '=', 'countries.Country_Id')
        ->join('states', 'cities.State_Id', '=', 'states.State_Id')
        ->select('cities.*', 'countries.Country_Name','states.State_Name')->get();
        //el subtype name w el main type name 
        return view('website.backend.database pages.Add_City_Show',['state'=>$states , 'country'=>$countries , 'city'=>$cities]);

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

        City::destroy($request->id);

      
        return redirect()->route('city_show');
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

    public function editCity(Request $request)
    {
        //hygeb el country eli el ID bt3ha da 
        $city= City::all()->find(request('id'));
        //hy7ot el name el gded f column el country name 
        $city->City_Name=request('CityName');
        $city->save();

        //hyb3t el update el gded fl country table 
        return response()->json($city);
    }
}
