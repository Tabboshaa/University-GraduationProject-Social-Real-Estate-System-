<?php

namespace App\Http\Controllers;

use App\Emails;
use App\Item;
use App\Main_Type;
use App\Sub_Type;
use App\User;
use App\User_Type;
use App\Country;

use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ItemController extends Controller
{
    public function index()
    {
        //
        $item= Item::all();
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Item',['main_type'=>$main_types,'item'=>$item]);

    }
    public function index1()
    {
        //
        $user_type = User_Type::all();
        $counrty=Country::all();
        return view('website.backend.database pages.AddItemSteps',['user_type' => $user_type,'counrty'=>$counrty]);
    }

    public function itemShow()
    {
        //

        return view('website.backend.database pages.Item')->with('success', 'Item Created Successfully');

    }


    public function SubTypeShow($id=null)
    {
        $sub_types=Sub_Type::all();
        $main_types=Main_Type::all();
        return view('website.backend.database pages.Item_Sub_Type_Show',['sub_type'=>$sub_types,'main_type'=>$main_types,'item_id'=>$id]);

    }
    public function create()
    {
        try {
            $item=Item::create([
                'Street_Id'=>request("Street"),
                'User_Id'=>request("Search")
            ]);
            $item_id=Arr::get($item, 'Item_Id');
            return $this->SubTypeShow($item_id);
            //return back()->with('success','Item Created Successfully');
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with('error','Already Exist !!');
            }
        }

    }
    public function searchEmail()
    {
        $search=request('email');
        $email=Emails::all()->where('email','=',$search)->get();
        return response()->json($email);

    }



}
