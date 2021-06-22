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
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct(Item $item, PaymentController $paymentController)
    {
        $this->item = $item;
        $this->paymentController = $paymentController;
    }
    public function index()
    {
        //
        $item = $this->item->all();
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

        // $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=', $User_id)->get();
        $user = $item->user;

        $email = Arr::get(Emails::all()->where('User_ID', '=', $User_id)->first(), 'email');
                              

        $phone_number = Arr::get(Phone_Numbers::all()->where('User_ID', '=', $User_id)->first(), '');

        $Location = DB::table('streets')
            ->leftJoin('countries', 'streets.Country_Id', '=', 'countries.Country_Id')
            ->leftJoin('states', 'streets.State_Id', '=', 'states.State_Id')
            ->leftJoin('cities', 'streets.City_Id', '=', 'cities.City_Id')
            ->leftJoin('regions', 'streets.Region_Id', '=', 'regions.Region_Id')
            ->select('streets.*', 'countries.Country_Name', 'states.State_Name', 'cities.City_Name', 'regions.Region_Name')
            ->get()->where('Street_Id', '=', $Street_id)->pop();

        $details = Details::query()
            ->join('main__types', 'details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->select('details.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'property__details.Detail_Name')
            ->get()->where('Item_Id', '=', $id)->groupBy(['Property_Name', 'Property_diff']);


        $Sub_Type_Id = Arr::get(Details::all()->where('Item_Id', '=', $id)->first(), 'Sub_Type_Id');


        return view('website.backend.database pages.ShowItem', ['user' => $user, 'Location' => $Location, 'details' => $details, 'item_id' => $id, 'subtypeid' => $Sub_Type_Id, 'email' => $email, 'phone_number' => $phone_number, 'user_id' => $User_id]);
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

    public function OwnerSelectProperty($item_id = null, $sub_type_id = null)
    {
        //
        $sub_type= Sub_Type::all()->where('Sub_Type_Id', '=', $sub_type_id)->first()->Sub_Type_Name;
        $property = Sub_Type_Property::all()->where('Sub_Type_Id', '=', $sub_type_id);
        return view('website.frontend.Owner.Owner_Select_Details', ['property' => $property, 'item_id' => $item_id,'sub_type'=>$sub_type]);
    }
    public function SelectSubType($id = null)
    {
        $main_types = Main_Type::all()->where('Main_Type_Id', '=', 1)->first()->Main_Type_Name;
        $main_type_id = Main_Type::all()->where('Main_Type_Id', '=', 1)->first()->Main_Type_Id;
        $sub_types = Sub_Type::all()->where('Main_Type_Id', '=', $main_type_id);
        return view('website.frontend.Owner.Owner_Select_Sub_Type', ['main_type_id' => $main_type_id, 'sub_type' => $sub_types, 'main_type' => $main_types, 'item_id' => $id]);
    }
    public function OwnerAddItem()
    {
         $user_id=Auth::id();
        $item = Item::create([
            'User_Id' => $user_id,
            'Street_Id' => request("StreetSelect"),
            'Item_Name' => request("Item_Name"),
            'address_longitude'=>request('longitude'),
            'address_latitude'=>request('latitude'),
        ]);
        $item_id = Arr::get($item, 'Item_Id');
        return $this->SelectSubType($item_id);
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
        return back()->with('success', 'Item Created Successfully');
    }
    public function ShowEditlocation($id = null)
    {
        $item_id = $id;
        $region = Region::all();
        $city = City::all();
        $states = State::all();
        $countries = Country::all();
        $streets = Street::all();
        //el subtype name w el main type name
        return view('website.backend.database pages.Edit_Item_Location', ['counrty' => $countries, 'state' => $states, 'city' => $city, 'region' => $region, 'street1' => $streets, 'item_id' => $item_id]);
    }
    public function EditLocation($id = null)
    {

        $item = Item::all()->find($id);
        $item->Street_Id = request('Street_Name');
        $item->save();

        return $this->show($id)->with('success', 'Location Edited Successfully');
    }

    public function ShowEditUser($id = null)
    {
        $item_id = $id;

        return view('website.backend.database pages.Edit_Item_User', ['item_id' => $item_id]);
    }

    public function EditUser($id = null)
    {
        $item = Item::all()->find(request('id'));
        $item->User_Id = request('userIdHiddenInput');
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
        if ($id != null) {
            try {
                Item::destroy($id);
                return redirect()->route('Details')->with('success', 'Item Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
<<<<<<< Updated upstream

                return redirect()->route('Details') > with('error', 'Item cannot be deleted');
=======
                return back()->withError($e->getMessage())->withInput();
                return redirect()->route('Details')->with('error', 'Item cannot be deleted');
>>>>>>> Stashed changes
            }
            
        } else return redirect()->route('Details')->with('warning', 'No Item was chosen to be deleted.. !!');
    }
    public function EditItemMap($itemId=null){

            $item=Item::all()->find($itemId);
            $item->address_latitude=\request('lat');
            $item->address_longitude=\request('lang');
            $item->save();
            return redirect()->back()->with('success','Location Changed Successfully');
    }

    public static function getnewestitems()
    {
        $item_ids = DB::table('items')->orderBy('created_at', 'DESC')->paginate(6);
        $items = [];

        if ($item_ids != null) {
            foreach ($item_ids as $item_id) {
                $item = Item::all()->where('Item_Id', '=', $item_id->Item_Id);
                $items = collect($items)->merge($item);
            }
        }
        return $items;
    }
    public static function getpopularitems()
    {
        $item_ids = DB::table('followeditemsbyusers')
            ->selectRaw('Item_Id, COUNT(*) as count')
            ->groupBy('Item_Id')
            ->orderBy('count', 'desc')
            ->paginate(6);

        $items = [];

        if ($item_ids != null) {
            foreach ($item_ids as $item_id) {
                $item = Item::all()->where('Item_Id', '=', $item_id->Item_Id);
                $items = collect($items)->merge($item);
            }
        }
        
        return $items;
    }

    public static function getowner($id)
    {
        return  $item = Item::all()->where('Item_Id', '=', $id)->User_Id;
    }
}
