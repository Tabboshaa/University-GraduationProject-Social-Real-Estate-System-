<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\State;
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
        $city = City::all();
        $countries = Country::all();
        $states = State::paginate(10);


        return view('website\backend.database pages.Add_City', ['country' => $countries, 'state' => $states, 'cityy' => $city]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        //
        DB::beginTransaction();
        try {
            $city = City::create([
                'City_Name' => request('City_Name'),
                'Country_Id' => request('Country_Name'),
                'State_Id'  => request('State_Name')
            ]);
            DB::commit();
            return back()->with('success', 'City Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'City Already Exist !!');
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
        try{
        $states = State::all();
        $countries = Country::all();
        $cities = DB::table('cities')
            ->join('countries', 'cities.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'cities.State_Id', '=', 'states.State_Id')
            ->select('cities.*', 'countries.Country_Name', 'states.State_Name')->paginate(10);
        //el subtype name w el main type name
        return view('website.backend.database pages.Add_City_Show', ['state' => $states, 'country' => $countries, 'cityy' => $cities]);
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
        DB::beginTransaction();

        if (request()->has('id')) {
            try {
                City::destroy($request->id);
                DB::commit();
                return redirect()->route('city_show')->with('success', 'City Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('city_show')->with('error', 'City cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else
            return redirect()->route('city_show')->with('warning', 'No City was chosen to be deleted.. !!');
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
    public function editCity()
    {
        DB::beginTransaction();
        try {
            //hygeb el country eli el ID bt3ha da
            $city = City::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $city->City_Name = request('CityName');
            $city->save();
            DB::commit();
            return back()->with('info', 'City Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Duplicated data');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
