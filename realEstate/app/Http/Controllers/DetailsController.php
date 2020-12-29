<?php

namespace App\Http\Controllers;

use App\Details;
use App\Item;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DetailsController extends Controller
{

    public function index()
    {
       
        $main_types = Main_Type::all();
        $sub_types = Sub_Type::all();
        $property = Sub_Type_Property::all();
        $property_details = Property_Details::all();
        $item = Item::all();
        //$subtype= get all sup type where main type id selected main  type
        return view('website.backend.database pages.Details', ['main_type' => $main_types, 'sub_type' => $sub_types, 'property_detail' => $property_details, 'item' => $item, 'property' => $property]);
    }

    public function create()
    {
      
     $detailsInput=request('data');
     
     foreach ($detailsInput as $detail)
     {
         $property_details=Property_Details::all()->where('Property_Detail_Id','=',Arr::get($detail,'id'))->first(); 

         $details[] = [
             'Item_Id' => request('item_id'),
             'Main_Type_Id' => Arr::get($property_details,'Main_Type_Id'),
             'Sub_Type_Id' => Arr::get($property_details,'Sub_Type_Id'),
             'Property_Id'=> Arr::get($property_details,'Property_Id'),
             'property_Detail_Id' => Arr::get($property_details,'Property_Detail_Id'),
             'DetailValue' => Arr::get($detail,'value')
         ];
     }


        try {
            Details::insert($details);

            // $Detail = Details::create([
            //     'Item_Id' => 1,
            //     'Main_Type_Id' => request('Main_Type_Name'),
            //     'Sub_Type_Id' => request('Sub_Type_Name'),
            //     'Property_Id'=>request('Propety_Detail'),
            //     'property_Detail_Id' => request('property_Detail_Name'),
            //     'DetailValue' => request('DetailValue')
            // ]);
            // return back()->with('success', 'Item Created Successfully');
           
        return back()->with('success', 'Detail Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Detail Already Exist !!');
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
        $details = Details::all();
        $item = Item::all();
        return view('website.backend.database pages.Details_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'property_detail' => $property_details, 'detail' => $details, 'item' => $item, 'property' => $property]);
    }
    public function edit()
    {
        //
        try {
       
            $detail = Details::all()->find(request('id'));
            $detail->DetailValue = request('DetailName');
            $detail->save();

                return back()->with('info','Detail Edited Successfully');
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error','Error editing Detail');
                }
            }
    }
    public function destroy(Request $request, $id)
    {
        //
        if(request()->has('id'))
       {
        try {
        Property_Details::destroy($request->id);
        return redirect()->route('details_show')->with('success', 'Detail Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return redirect()->route('details_show')->with('error', 'Detail cannot be deleted');
                
    }
}else return redirect()->route('details_show')->with('warning', 'No Detail was chosen to be deleted.. !!');
    }
 
}
