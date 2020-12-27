<?php

namespace App\Http\Controllers;

use App\Emails;
use App\Item;
use App\Main_Type;
use App\Street;
use App\Sub_Type;
use App\User;
use App\User_Type;
use App\Country;

use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;

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

    public  function show($id=null)
    {
        $item=Item::all('Street_Id','User_Id')->where('Item_Id','=',$id);
        //return dd($item);
        $User_id=Arr::get($item, 'User_Id');
       // return dd($User_id); Item_Id
        $Item_id=Arr::get($item, 'Item_Id');

        $Street_id=Arr::get($item, 'Street_Id');

        $user=User::all('First_Name','Middle_Name','Last_Name')->where('id','=',$User_id);

        $Location=DB::table('streets')
            ->join('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'streets.State_Id', '=', 'states.State_Id')
            ->join('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->join('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->select('streets.Street_Name', 'countries.Country_Name','states.State_Name','cities.City_Name','regions.Region_Name')
            ->get()->where('Street_Id','=',$Street_id)->first();

        $details= DB::table('details')
            ->join('main__types', 'details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->select('details.DetailValue', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'property__details.Detail_Name')
            ->get()->where('Item_Id','=',$Item_id)->first();

            return dd($details);

        return view('website.backend.database pages.ShowItem',['user'=>$user,'Location'=>$Location,'details'=>$details]);
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
