<?php

namespace App\Http\Controllers;

use App\State;
use App\Street;
use App\City;
use App\Region;
use App\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        //
        $countries = Country::all();
        return view('website\backend.database pages.Add_State', ['country' => $countries]);
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
            $state = State::create([
                'State_Name' => request('State_Name'),
                'Country_Id' => request('country_name')
                
            ]);
            DB::commit();
            return back()->with('success', 'State Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'State Already Exists !!');
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
        $countries = Country::all();
        try{
        $states = DB::table('states')
            ->join('countries', 'states.Country_Id', '=', 'countries.Country_Id')
            ->select('states.*', 'countries.Country_Name')->paginate(10);

        return view('website\backend.database pages.Add_State_Show', ['state1' => $states, 'country' => $countries]);
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
        // Will Destroy each column with id form action
        if (request()->has('id')) {
            DB::beginTransaction();
            
            try {
                State::destroy($request->id);
                DB::commit();
                return redirect()->route('state_show')->with('success', 'State Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('state_show')->with('error', 'State cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        

        } else return redirect()->route('state_show')->with('warning', 'No State was chosen to be deleted.. !!');
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
    public function editState(Request $request)
    {
        DB::beginTransaction();
        
        try {
            
            //hygeb el country eli el ID bt3ha da
            $state = State::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $state->State_Name = request('StateName');
            $state->save();
            
            DB::commit();
            //hyb3t el update el gded fl country table
            return back()->with('info', 'State Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing State');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public static function findstatebyname($statename)
    {
try{
        $state = State::where('State_Name', 'like', '%' . $statename . '%')->get('State_Id')->first();
        if($state != null){
        return $state->State_Id;
        }
        else return null;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public static function getStates()
    {
        try{
        $states = State::get('State_Name');
        return $states;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}}
