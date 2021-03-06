<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Region;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {try{
        //
        $counrty = Country::all();
        $state = State::all();
        $city = City::all();
        return view('website.backend.database pages.Add_Region', ['counrty' => $counrty, 'state' => $state, 'city' => $city]);
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
            $region = Region::create([
                'Country_Id' => request('Country_Name'),
                'State_Id' => request('State_Name'),
                'City_Id' => request('City_Name'),
                'Region_Name' => request('Region_Name')
            ]);
            DB::commit();
            return back()->with('success', 'Region Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Region Already Exists !!');
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

        $city = City::all();
        $states = State::all();
        $countries = Country::all();
        try{
        $region = DB::table('regions')
            ->join('countries', 'regions.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'regions.State_Id', '=', 'states.State_Id')
            ->join('cities', 'regions.City_Id', '=', 'cities.City_Id')
            ->select('regions.*', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name')->paginate(10);
        //el subtype name w el main type name
        return view('website.backend.database pages.Add_Region_Show', ['counrty' => $countries, 'state' => $states, 'city' => $city, 'region1' => $region]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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
    public function destroy(Request $request, $id = null)
    {
        if (request()->has('id')) {
            DB::beginTransaction();

            try {
                Region::destroy($request->id);
                DB::commit();
                return redirect()->route('region_show')->with('success', 'Region Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
                return redirect()->route('region_show')->with('error', 'Region cannot be deleted');
            }
        } else return redirect()->route('region_show')->with('warning', 'No Region was chosen to be deleted.. !!');
    }

    public function findstate()
    {
try{
        //will get all states which her Country_Id is the ID we passed from $.ajax
        $state = State::all()->where('Country_Id', '=', request('id'));

        // will send all values in state object by json
        return  response()->json($state);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public function findcity()
    {
try{
        //will get all states which her Country_Id is the ID we passed from $.ajax
        $city = City::all()->where('State_Id', '=', request('id'));

        // will send all values in state object by json
        return  response()->json($city);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public function findregion()
    {
try{
        //will get all states which her Country_Id is the ID we passed from $.ajax
        $region = Region::all()->where('City_Id', '=', request('id'));

        // will send all values in state object by json
        return  response()->json($region);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public function editRegion(Request $request)
    {
        DB::beginTransaction();

        try {

            //hygeb el country eli el ID bt3ha da
            $region = Region::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $region->Region_Name = request('RegionName');
            $region->save();

            DB::commit();
            return back()->with('info', 'Region Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Region');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
