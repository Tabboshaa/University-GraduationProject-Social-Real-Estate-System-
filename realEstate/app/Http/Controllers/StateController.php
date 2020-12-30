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
        //
        $countries=Country::all();
        return view('website\backend.database pages.Add_State',['country'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //

       try 
        {
            $state=State::create([
            'State_Name' => request('State_Name'),
            'Country_Id' => request('country_name')

        ]);
        return back()->with('success','State Created Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','State Already Exists !!');
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
        //
        $countries=Country::paginate(1);
        $states=DB::table('states')
        ->join('countries', 'states.Country_Id', '=', 'countries.Country_Id')
        ->select('states.*', 'countries.Country_Name')->paginate(10);

        return view('website\backend.database pages.Add_State_Show',['state1'=>$states,'country'=>$countries]);
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
    public function destroy(Request $request,$id=null)
    {
        // Will Destroy each column with id form action
        if(request()->has('id'))
       {
        try {
        State::destroy($request->id);
        return redirect()->route('state_show')->with('success', 'State Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return redirect()->route('state_show')->with('error', 'State cannot be deleted');

    }
}else return redirect()->route('state_show')->with('warning', 'No State was chosen to be deleted.. !!');
    }
    public function findstate(){

        //will get all states which her Country_Id is the ID we passed from $.ajax
        $state=State::all()->where('Country_Id','=',request('id'));

        // will send all values in state object by json
        return  response()->json($state);


    }

    public function editState(Request $request)
    {
        try {

        //hygeb el country eli el ID bt3ha da
        $state= State::all()->find(request('id'));
        //hy7ot el name el gded f column el country name
        $state->State_Name=request('StateName');
        $state->save();

        //hyb3t el update el gded fl country table
        return back()->with('info','State Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Error editing item');
        }
    }
    }
}
