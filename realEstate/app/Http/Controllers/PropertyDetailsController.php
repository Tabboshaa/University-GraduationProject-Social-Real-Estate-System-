<?php

namespace App\Http\Controllers;

use App\Datatype;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class PropertyDetailsController extends Controller
{
    public function index()
    {
        $main_types = Main_Type::all();
        $sub_types = Sub_Type::all();
        $property = Sub_Type_Property::all();
        $data_type = Datatype::all();
        return view('website.backend.database pages.Property_Details', ['main_type' => $main_types, 'sub_type' => $sub_types, 'property' => $property, 'data_type' => $data_type]);
    }

    public function create()
    {
      
        try {
            $Property_Detail = Property_Details::create([
                'Main_Type_Id' => request('Main_Type_Name'),
                'Sub_Type_Id' => request('Sub_Type_Name'),
                'Property_Id' => request('Sub_Type_Property'),
                'DataType_Id' => request('Data_Type_Name'),
                'Detail_Name' => request('property_details')
            ]);
            return back()->with('success', 'Property Detail Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Property Detail Already Exists !!');
            }
        }
    }

    public function show()
    {
        //
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        $property = Sub_Type_Property::all();
        $property_details = Property_Details::all();
        $data_type = Datatype::all();
        $property = DB::table('property__details')
            ->join('main__types', 'property__details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'property__details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'property__details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('datatypes', 'property__details.DataType_Id', '=', 'datatypes.id')
            ->select('property__details.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'datatypes.datatype')
            ->get();

        return view('website.backend.database pages.Property_Details_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'property_detail' => $property_details, 'property' => $property, 'data_type' => $data_type]);
    }

    //    function of drop downlist : AJAX
    public function find()
    {

        $property_details = Property_Details::all()->where('Property_Detail_Id', '=', request('id'));

        return  response()->json($property_details);
    }
    public function edit()
    {
        //
        try {
        $propertydetail = Property_Details::all()->find(request('id'));
        $propertydetail->Detail_Name = request('PropertyDetailName');
        $propertydetail->save();
        return back()->with('info','Property Detail Edited Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Error editing Property Detail');
        }
    }
    }
    public function destroy(Request $request)
    {
        //
        if(request()->has('id'))
       {
        try {
        Property_Details::destroy($request->id);
        
        return redirect()->route('property_detail_show')->with('success', 'Property Detail Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return redirect()->route('property_detail_show')->with('error', 'Property Detail cannot be deleted');
                
    }
}else return redirect()->route('property_detail_show')->with('warning', 'No Property Detail was chosen to be deleted.. !!');
    }
    
    public function submit_properties()
    {
        //
        $property = Sub_Type_Property::all()->whereIn('Property_Id',request('property'));
        $details= Property_Details::all();
        return view('website.backend.database pages.Detail_Page', ['property' => $property,'details'=>$details]);
  
    }
    public function findDetailsForForm()
    {
        $details=DB::table('property__details')
        ->join('datatypes', 'property__details.DataType_Id', '=', 'datatypes.id')
            ->select('property__details.*','datatypes.datatype')
            ->get()
            ->where('Property_Id','=',request('id'));
        
        return response()->json($details);
    }
}
