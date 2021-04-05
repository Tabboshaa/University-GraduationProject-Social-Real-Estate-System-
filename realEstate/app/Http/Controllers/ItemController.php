<?php

namespace App\Http\Controllers;
use App\schedule;
use App\Street;
use App\City;
use App\Country;
use App\Region;
use App\State;
use App\Emails;
use App\Phone_Numbers;
use App\Item;
use App\Main_Type;
use App\Sub_Type;
use App\User;
use App\User_Type;
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
        $item = Item::all()->where('Item_Id', '=', $id)->first();
        // return $item;

        $User_id = Arr::get($item, 'User_Id');

        $Item_id = Arr::get($item, 'Item_Id');

        $Street_id = Arr::get($item, 'Street_Id');

        $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=', $User_id)->get();

        $email = Arr::get(Emails::all()->where('User_ID', '=', $User_id)->first(),'email');


        $phone_number = Arr::get(Phone_Numbers :: all()->where('User_ID', '=', $User_id)->first(),'');

        $Location = DB::table('streets')
            ->leftJoin('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->leftJoin('states', 'streets.State_Id', '=', 'states.State_Id')
            ->leftJoin('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->leftJoin('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->select('streets.*', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name', 'regions.Region_Name')
            ->get()->where('Street_Id', '=',$Street_id)->pop();


        $details = DB::table('details')
            ->join('main__types', 'details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->select('details.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'property__details.Detail_Name')
            ->get()->where('Item_Id', '=', $id)->groupBy(['Property_Name','Property_diff']);


        $Sub_Type_Id = Arr::get(Details::all()->where('Item_Id', '=', $id)->first(), 'Sub_Type_Id');


        return view('website.backend.database pages.omniaShowItem', ['user' => $user, 'Location' => $Location, 'details' => $details, 'item_id' => $id, 'subtypeid' => $Sub_Type_Id,'email'=>$email,'phone_number' => $phone_number,'user_id'=>$User_id]);
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

            $item = Item::create([
                'Street_Id' => request("Street"),
                'User_Id' => request("userIdHiddenInput"),
                'Item_Name' => 'hamada'
            ]);
            $item_id = Arr::get($item, 'Item_Id');
            return $this->SubTypeShow($item_id);
            return back()->with('success','Item Created Successfully');


    }
    public function ShowEditlocation($id=null)
    {
        $item_id=$id;
        $region=Region::all();
        $city=City::all();
        $states=State::all();
        $countries=Country::all();
        $streets=Street::all();
        //el subtype name w el main type name
        return view('website.backend.database pages.Edit_Item_Location',['counrty'=>$countries,'state'=>$states,'city'=>$city,'region'=>$region,'street1'=>$streets,'item_id'=>$item_id]);
   }
   public function EditLocation($id=null)
   {

    $item=Item::all()->find($id);
    $item->Street_Id=request('Street_Name');
    $item->save();

     return $this->show($id)->with('success', 'Location Edited Successfully');
    }

    public function ShowEditUser($id=null)
    {
        $item_id=$id;

        return view('website.backend.database pages.Edit_Item_User',['item_id'=>$item_id]);
   }

    public function EditUser($id=null)
    {
        $item=Item::all()->find(request('id'));
        $item->User_Id=request('userIdHiddenInput');
        $item->save();
        return $this->show($id);
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
