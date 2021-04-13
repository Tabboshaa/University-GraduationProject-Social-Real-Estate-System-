<?php

namespace App\Http\Controllers;

use App\Datatype;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function show()
    {
        //
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        $property = Sub_Type_Property::all();
        $property_details = Property_Details::all();
        $data_type = Datatype::all();
        $property = DB::table('property__details')
            ->join('main__types', 'property__details.Main_Type_Id', '=', 'main__types.Main_Type_Id')
            ->join('sub__types', 'property__details.Sub_Type_Id', '=', 'sub__types.Sub_Type_Id')
            ->join('sub__type__properties', 'property__details.Property_Id', '=', 'sub__type__properties.Property_Id')
            ->join('datatypes', 'property__details.DataType_Id', '=', 'datatypes.id')
            ->select('property__details.*', 'main__types.Main_Type_Name', 'sub__types.Sub_Type_Name', 'sub__type__properties.Property_Name', 'datatypes.datatype')
            ->paginate(10);

        return view('website.backend.database pages.Reservation_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'property_detail' => $property_details, 'property' => $property, 'data_type' => $data_type]);
    }
}
