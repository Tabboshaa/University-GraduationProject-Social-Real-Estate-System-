<?php

namespace App\Http\Controllers;

use App\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try{
        $Countries = Country::paginate(10);
        return view('website.backend.database pages.Add_Country_Show', ['C11' => $Countries]);
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
            $country = Country::create([
                'Country_Name' => request('country_name'),
            ]);
            DB::commit();
            return back()->with('success', 'Country Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Country Already Exist !!');
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
        DB::beginTransaction();

        if (request()->has('id')) {
            try {
                Country::destroy($request->id);
                DB::commit();
                return redirect()->route('country_show')->with('success', 'Country Deleted Successfully');
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('country_show')->with('error', 'Country cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('country_show')->with('warning', 'No Country was chosen to be deleted.. !!');
    }
    //  function  EDIT: AJAX

    public function editCountry(Request $request)
    {
        DB::beginTransaction();
        try {

            //hygeb el country eli el ID bt3ha da
            $country = Country::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $country->Country_Name = request('CountryName');
            $country->save();
            DB::commit();
            return back()->with('info', 'Country Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Country');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
