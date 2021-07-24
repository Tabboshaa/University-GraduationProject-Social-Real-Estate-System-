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
        try{
        $counrty = Country::all();
        $state = State::all();
        $city = City::all();
        $region = Region::all();
        $street = Street::paginate(10);
        return view('website.backend.database pages.Add_Street', ['counrty' => $counrty, 'state' => $state, 'city' => $city, 'region' => $region, 'street1' => $street]);
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
       

        DB::beginTransaction();
        try {
            $street = Street::create([
                'Country_Id' => request('Country_Name'),
                'State_Id' => request('State_Name'),
                'City_Id' => request('City_Name'),
                'Region_Id' => request('Region_Name'),
                'Street_Name' => request('Street_Name')
            ]);
            DB::commit();
            return back()->with('success', 'Street Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Street Already Exists !!');
            }
            if ($errorCode == 1048) {
                return back()->with('error', 'You must select all values!!');
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
    public function store()
    {
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

        $region = Region::all();
        $city = City::all();
        $states = State::all();
        $countries = Country::all();
        try{
        $streets = DB::table('streets')
            ->join('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'streets.State_Id', '=', 'states.State_Id')
            ->join('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->join('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->select('streets.*', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name', 'regions.Region_Name')->paginate(10);
        //el subtype name w el main type name
        return view('website.backend.database pages.Add_Street_Show', ['counrty' => $countries, 'state' => $states, 'city' => $city, 'region' => $region, 'street1' => $streets]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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
    public function destroy(Request $request, $id = null)
    {
        if (request()->has('id')) {
            DB::beginTransaction();
            
            try {
                
                Street::destroy($request->id);
                DB::commit();
                return redirect()->route('street_show')->with('success', 'Street Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
                return redirect()->route('street_show')->with('error', 'Street cannot be deleted');
            }
        } else return redirect()->route('street_show')->with('warning', 'No Street was chosen to be deleted.. !!');
    }
    public function editStreet(Request $request)
    {
        DB::beginTransaction();
        
        try {
            //hygeb el country eli el ID bt3ha da
            $street = Street::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $street->Street_Name = request('StreetName');
            $street->save();
            
            DB::commit();
            //hyb3t el update el gded fl country table
            return back()->with('info', 'Street Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Street');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function findstreet()
    {
        try{

        //will get all states which her Country_Id is the ID we passed from $.ajax
        $street = Street::all()->where('Region_Id', '=', request('id'));

        // will send all values in state object by json
        return response()->json($street);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
}
