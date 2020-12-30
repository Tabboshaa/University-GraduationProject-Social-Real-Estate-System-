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
use App\Details;
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
        $item = Item::all();
        $main_types = Main_Type::all();
        return view('website.backend.database pages.Item', ['main_type' => $main_types, 'item' => $item]);
    }
    public function index1()
    {
        //
        $user_type = User_Type::all();
        $counrty = Country::all();
        return view('website.backend.database pages.AddItemSteps', ['user_type' => $user_type, 'counrty' => $counrty]);
    }

    public  function show($id = null)
    {
        //lw gy mn el ajax fe el detail blade
        if ($id == null && request()->has('Item')) $id = request('Item');
        $item = Item::all('Street_Id', 'User_Id')->where('Item_Id', '=', $id);
        // return $item;

        $User_id = Arr::get($item, 'User_Id');

        $Item_id = Arr::get($item, 'Item_Id');

        $Street_id = Arr::get($item, 'Street_Id');

        $user = User::all('First_Name', 'Middle_Name', 'Last_Name')->where('id', '=', $User_id)->first();

        $Location = DB::table('streets')
            ->join('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->join('states', 'streets.State_Id', '=', 'states.State_Id')
            ->join('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->join('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->select('streets.Street_Name', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name', 'regions.Region_Name')
            ->get()->where('Street_Id', '=', $Street_id)->first();

        $details = DB::table('details')
            ->join('main__types', 'details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->select('details.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'property__details.Detail_Name')
            ->get()->where('Item_Id', '=', $id)->groupBy('Property_Name');

        $Sub_Type_Id = Arr::get(Details::all()->where('Item_Id', '=', $id)->first(), 'Sub_Type_Id');

        return view('website.backend.database pages.omniaShowItem', ['user' => $user, 'Location' => $Location, 'details' => $details, 'item_id' => $id, 'subtypeid' => $Sub_Type_Id]);
    }

    public function itemShow()
    {
        //

        return view('website.backend.database pages.Item')->with('success', 'Item Created Successfully');
    }


    public function SubTypeShow($id = null)
    {
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        return view('website.backend.database pages.Item_Sub_Type_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'item_id' => $id]);
    }
    public function create()
    {
        try {
            $item = Item::create([
                'Street_Id' => request("Street"),
                'User_Id' => request("userIdHiddenInput")
            ]);
            $item_id = Arr::get($item, 'Item_Id');
            return $this->SubTypeShow($item_id);
            //return back()->with('success','Item Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
        }
    }
    public function EditUser()
    {
        $item=Item::all()->find(request('id'));
        $item->User_Id=request('User_Id');
        $item->save();
    }
    public function searchEmail()
    {
        $search = request('email');
        $email = Emails::all()->where('email', '=', $search);
        return response()->json($email);
    }

    public function destroy($id = null)
    {
        // Details
        if ($id!=null) {
            try {
                Item::destroy($id);
                return redirect()->route('Details')->with('success', 'Item Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {

                return redirect()->route('Details')>with('error', 'Item cannot be deleted');
            }
        } else return redirect()->route('Details')->with('warning', 'No Item was chosen to be deleted.. !!');
    }
}
