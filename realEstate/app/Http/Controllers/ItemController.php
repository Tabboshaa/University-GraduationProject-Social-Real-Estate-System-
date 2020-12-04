<?php

namespace App\Http\Controllers;

use App\Item;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        //
        $item= Item::all();
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Item',['main_type'=>$main_types,'item'=>$item]);

    }

    public function SubTypeShow($id)
    {
        $sub_types=Sub_Type::all()->where('Main_Type_Id','=',$id);
        return view('website.backend.database pages.Item_Sub_Type_Show',['sub_type'=>$sub_types,'main_id'=>$id]);

    }

    public function DetailShow($main_id,$id)
    {
        $sub_type_property=Sub_Type_Property::all()->where('Sub_Type_Id','=',$id); //room w bathroom w balacony
        $property=Property_Details::all()->where('Sub_Type_Id','=',$id); //area 
        return view('website.backend.database pages.Detail_Page',['sub_type'=>$id,'main_type'=>$main_id,'property'=>$sub_type_property,'detail'=>$property]);

    }

    public function submit($main_id,$sub_id,$property_id)
    {
        $no= request()->all();
        // return $no[1];
        foreach (($no) as $propertyDetail => $value) {

            // create eeeeeh creat eeeeeh  
            // detail insert Main_Type_Id=> $main_id , Sub_Type_Id=>$sub_id , Property_Id=>property_id , Property_Detail_Id=>$propertyDetail , DetailValue=>value
            echo "$propertyDetail: $value\n";
          }
    
    }

}
