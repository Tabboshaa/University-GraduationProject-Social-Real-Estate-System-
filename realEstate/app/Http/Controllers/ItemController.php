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

    public function SubTypeShow()
    {
        $sub_types=Sub_Type::all();
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Item_Sub_Type_Show',['sub_type'=>$sub_types,'main_type'=>$main_types]);

    }
    public function create()
    {
      
    }


}
