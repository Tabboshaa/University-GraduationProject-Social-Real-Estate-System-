<?php

namespace App\Http\Controllers;

use App\Main_Type;
use App\Sub_Type;
use App\sub_type_property;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

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
        try{
        $main_types = Main_Type::all();
        $sub_types = Sub_Type::all();
        return view('website.backend.database pages.Sub_Type_Property', ['main_type' => $main_types, 'sub_type' => $sub_types]);
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
        //

       

        DB::beginTransaction();
        try {
            $Property_Detail = sub_type_property::create([
                'Main_Type_Id' => request('Main_Type_Name'),
                'Sub_Type_Id' => request('Sub_Type_Name'),
                'Property_Name' => request('Sub_Type_Property')
            ]);
            DB::commit();
            return back()->with('success', 'Property Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Property Already Exists !!');

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
    public static function getAllSubtypeProperties($id = null)
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
        try{
        $property = DB::table('sub__type__properties')
            ->join('main__types', 'sub__type__properties.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'sub__type__properties.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->select('sub__type__properties.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name')->paginate(10);
        //el subtype name w el main type name
        return view('website.backend.database pages.Sub_Type_Property_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'P1' => $property]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    //    function of drop downlist : AJAX
    public function find()
    {
try{
        $property = Sub_Type_Property::all()->where('Sub_Type_Id', '=', request('id'));

        return  response()->json($property);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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
        DB::beginTransaction();
        
        try {
            $subtypeproperty = Sub_Type_Property::all()->find(request('id'));
            $subtypeproperty->Property_Name = request('SubTypePropertyName');
            $subtypeproperty->save();
            DB::commit();
            return back()->with('info','Property Edited Successfully');
        }catch (\Exception $e){
        DB::rollBack();
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Duplicated data');
        }
        return back()->withError($e->getMessage())->withInput();
    }
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
    public function destroy(Request $request)
    {
        //
        if(request()->has('id'))
       {
        DB::beginTransaction();
        
        try {
            Sub_Type_Property::destroy($request->id);
            DB::commit();
            return redirect()->route('subtypeproperty_show')->with('success', 'Property Deleted Successfully');
        }catch (\Exception $e){
        DB::rollBack();

        return redirect()->route('subtypeproperty_show')->with('error', 'Property cannot be deleted');
        return back()->withError($e->getMessage())->withInput();
    }
    }else return redirect()->route('subtypeproperty_show')->with('warning', 'No Property was chosen to be deleted.. !!');
    }
//function that sends the property details that are desplayed in checkboxes
    public function property_select($item_id=null,$sub_type_id=null)
    {
        //
        try{
        $property = Sub_Type_Property::all()->where('Sub_Type_Id','=',$sub_type_id);

        return view('website.backend.database pages.Properties_Select', ['property' => $property,'item_id'=>$item_id]);
        }
        catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

}
