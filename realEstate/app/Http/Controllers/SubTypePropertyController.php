<?php

namespace App\Http\Controllers;

use App\Main_Type;
use App\Sub_Type;
use App\sub_type_property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubTypePropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $main_types = Main_Type::all();
        $sub_types = Sub_Type::all();
        return view('website.backend.database pages.Sub_Type_Property', ['main_type' => $main_types, 'sub_type' => $sub_types]);
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
            $Property_Detail = sub_type_property::create([
                'Main_Type_Id' => request('Main_Type_Name'),
                'Sub_Type_Id' => request('Sub_Type_Name'),
                'Property_Name' => request('Sub_Type_Property')
            ]);
            return back()->with('success', 'Item Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
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
     * @param  \App\sub_type_property  $sub_type_property
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        $property = DB::table('sub__type__properties')
            ->join('main__types', 'sub__type__properties.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'sub__type__properties.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->select('sub__type__properties.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name')->get();
        //el subtype name w el main type name 
        return view('website.backend.database pages.Sub_Type_Property_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'property' => $property]);
    }

    //    function of drop downlist : AJAX
    public function find()
    {

        $property = Sub_Type_Property::all()->where('Sub_Type_Id', '=', request('id'));

        return  response()->json($property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sub_type_property  $sub_type_property
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $subtypeproperty = Sub_Type_Property::all()->find(request('id'));
        // $subtypepropertypropertyproperty->Main_Type_Id=request('MainTypeid');
        // $subtypepropertyproperty->Sub_Type_Id=request('SubTypeid');
        $subtypeproperty->Property_Name = request('SubTypePropertyName');
        $subtypeproperty->save();

        return response()->json($subtypeproperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sub_type_property  $sub_type_property
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sub_type_property  $sub_type_property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        Sub_Type_Property::destroy($request->id);
        return redirect()->route('subtypeproperty_show');
    }
}
