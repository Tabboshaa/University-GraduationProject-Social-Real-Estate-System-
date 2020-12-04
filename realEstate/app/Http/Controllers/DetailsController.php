<?php

namespace App\Http\Controllers;

use App\Details;
use App\Item;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;

class DetailsController extends Controller
{

    public function index()
    {
        $main_types=Main_Type::all();
        $sub_types=Sub_Type::all();
        $property=Sub_Type_Property::all();
        $property_details=Property_Details::all();
        $item=Item::all();
        //$subtype= get all sup type where main type id selected main  type
        return view('website.backend.database pages.Details',['main_type'=>$main_types,'sub_type'=>$sub_types,'property_detail'=>$property_details,'item'=>$item,'property'=>$property]);
    }

    public function create()
    {

        $Detail = Details::create([
            'Item_Id'=> request('Item_Id'),
            'Main_Type_Id' => request('Main_Type_Name'),
            'Sub_Type_Id' => request('Sub_Type_Name'),
            'property_Detail_Id'=> request('property_Detail_Name'),
            'DetailValue' => request('DetailValue')
        ]);

        return $this->index();
    }

    public function show()
    {
        //
        $sub_types=Sub_Type::all();
        $main_types=Main_Type::all();
        $property=Sub_Type_Property::all();
        $property_details=Property_Details::all();
        $details=Details::all();
        $item=Item::all();
        return view('website.backend.database pages.Details_Show',['sub_type'=>$sub_types,'main_type'=>$main_types,'property_detail'=>$property_details,'detail'=>$details,'item'=>$item,'property'=>$property]);
    }
    public function edit()
    {
        //
        $detail=Details::all()->find(request('id'));
        // $subtypepropertypropertyproperty->Main_Type_Id=request('MainTypeid');
        // $subtypepropertyproperty->Sub_Type_Id=request('SubTypeid');
        $detail->DetailValue=request('DetailName');
        $detail->save();

        return response()->json($detail);
    }
    public function destroy(Request $request,$id)
    {
        //
        Property_Details::destroy($request->id);

       return $this->show();
       }
}
