<?php

namespace App\Http\Controllers;

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
use App\User_Type;
use App\Details;
use App\Sub_Type_Property;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct(Item $item, PaymentController $paymentController)
    {
        try{
        $this->item = $item;
        $this->paymentController = $paymentController;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function index()
    {
        try{
        //
        $item = $this->item->all();
        $main_types = Main_Type::all();
        return view('website.backend.database pages.Item', ['main_type' => $main_types, 'item' => $item]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function index1()
    {
        //
        try{
        $user_type = User_Type::all();
        $counrty = Country::all();
        return view('website.backend.database pages.AddItemSteps', ['user_type' => $user_type, 'counrty' => $counrty]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public  function show($id = null)
    {
        //lw gy mn el ajax fe el detail blade

        if ($id == null && request()->has('Item')) $id = request('Item');

        $item = Item::all()->where('Item_Id', '=', $id)->first();

        $User_id = Arr::get($item, 'User_Id');

        $Street_id = Arr::get($item, 'Street_Id');

        // $user =User::select('First_Name','Middle_Name','Last_Name')->where('id', '=', $User_id)->get();
        $user = $item->user;

        $email = Arr::get(Emails::all()->where('User_ID', '=', $User_id)->first(), 'email');


        $phone_number = Arr::get(Phone_Numbers::all()->where('User_ID', '=', $User_id)->first(), '');
try{
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


        return view('website.backend.database pages.ShowItem', ['user' => $user, 'Location' => $Location, 'details' => $details, 'item_id' => $id, 'subtypeid' => $Sub_Type_Id, 'email' => $email, 'phone_number' => $phone_number, 'user_id' => $User_id, 'item'=>$item]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
    }
    public function itemShow()
    {
        //
try{
        return view('website.backend.database pages.Item')->with('success', 'Item Created Successfully');
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public function SubTypeShow($id = null)
    {
        try{
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        return view('website.backend.database pages.Item_Sub_Type_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'item_id' => $id]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}

    public function OwnerSelectProperty($item_id = null, $sub_type_id = null)
    {
        try{
        //
        $sub_type = Sub_Type::all()->where('Sub_Type_Id', '=', $sub_type_id)->first()->Sub_Type_Name;
        $property = Sub_Type_Property::all()->where('Sub_Type_Id', '=', $sub_type_id);
        return view('website.frontend.Owner.Owner_Select_Details', ['property' => $property, 'item_id' => $item_id, 'sub_type' => $sub_type]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function SelectSubType($id = null)
    {
        try{
        $main_types = Main_Type::all()->where('Main_Type_Id', '=', 1)->first()->Main_Type_Name;
        $main_type_id = Main_Type::all()->where('Main_Type_Id', '=', 1)->first()->Main_Type_Id;
        $sub_types = Sub_Type::all()->where('Main_Type_Id', '=', $main_type_id);
        return view('website.frontend.Owner.Owner_Select_Sub_Type', ['main_type_id' => $main_type_id, 'sub_type' => $sub_types, 'main_type' => $main_types, 'item_id' => $id]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function OwnerAddItem()
    {

        $user_id = Auth::id();
        DB::beginTransaction();
        try {
            $item = Item::create([
                'User_Id' => $user_id,
                'Street_Id' => request("StreetSelect"),
                'Item_Name' => request("Item_Name"),
                'address_longitude' => request('longitude'),
                'address_latitude' => request('latitude'),
            ]);
            $item_id = Arr::get($item, 'Item_Id');
            DB::commit();
            return $this->SelectSubType($item_id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function create()
    {
        DB::beginTransaction();
        try {
            $item = Item::create([
                'Street_Id' => request("Street"),
                'User_Id' => request("userIdHiddenInput"),
                'Item_Name' => request("item_Name"),
            ]);
            $item_id = Arr::get($item, 'Item_Id');
            DB::commit();
            return $this->SubTypeShow($item_id);
            return back()->with('success', 'Item Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
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
        try{
        return view('website.backend.database pages.Edit_Item_Location', ['counrty' => $countries, 'state' => $states, 'city' => $city, 'region' => $region, 'street1' => $streets, 'item_id' => $item_id]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function EditLocation($id = null)
    {
        DB::beginTransaction();

        try {
            $item = Item::all()->find($id);
            $item->Street_Id = request('Street_Name');
            $item->save();

            DB::commit();
            return $this->show($id)->with('success', 'Location Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            return $this->show($id)->with('error', 'Error Editing Location');
        }
    }

    public function ShowEditUser($id = null)
    {
        $item_id = $id;
try{
        return view('website.backend.database pages.Edit_Item_User', ['item_id' => $item_id]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public function EditUser($id = null)
    {
        DB::beginTransaction();

        try {
            $item = Item::all()->find(request('id'));
            $item->User_Id = request('userIdHiddenInput');
            $item->save();
            DB::commit();
            return $this->show($id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
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
            DB::beginTransaction();
            try {
                Item::destroy($id);
                DB::commit();

                if (TypeOfUserController::checkIfAdmin())
                    return redirect()->route('Details')->with('success', 'Item Deleted Successfully');
                else{

                    return redirect()->route('MyItems');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
            }
        } else {
            if (TypeOfUserController::checkIfAdmin())
            return redirect()->route('Details')->with('warning', 'No Item was chosen to be deleted.. !!');
            else  return back()->with('warning', 'Error occured while deleting item');

    }}

    public function EditItemMap($itemId = null)
    {
        DB::beginTransaction();
        try {
            $item = Item::all()->find($itemId);
            $item->address_latitude = \request('lat');
            $item->address_longitude = \request('lang');
            $item->save();

            DB::commit();
            return redirect()->back()->with('success', 'Location Changed Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error editing Detail');
        }
    }

    public static function getnewestitems()
    {
        $item_ids = DB::table('items')->orderBy('created_at', 'DESC')->paginate(6);
        $items = [];

        if ($item_ids != null) {
            try{
            foreach ($item_ids as $item_id) {
                $item = Item::all()->where('Item_Id', '=', $item_id->Item_Id);
                $items = collect($items)->merge($item);
            }}
            catch (\Exception $e) {
                return back()->withError($e->getMessage())->withInput();

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
            try{
            foreach ($item_ids as $item_id) {
                $item = Item::all()->where('Item_Id', '=', $item_id->Item_Id);
                $items = collect($items)->merge($item);
            }

        }
        catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        }

        return $items;
    }

    public static function getowner($id)
    {
        try{
        return Item::all()->where('Item_Id', '=', $id)->first()->User_Id;
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
    public static function getitems()
    {
try{
        return Item::where('Item_Name', 'LIKE','%' .request('name').'%')->get();
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
}
}
