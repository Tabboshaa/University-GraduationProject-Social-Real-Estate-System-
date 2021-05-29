<?php

namespace App\Http\Controllers;

use App\Datatype;
use App\Emails;
use App\Main_Type;
use App\Operation__Detail_Value;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function show()
    {

        //1-Price_Per_Night
        //2-Start_Date
        //3-End_Date
        //4-Total_Price
        $values=DB::table('operation___detail__values')
            ->join('operation__detail_name', 'operation___detail__values.Detail_Id', '=', 'operation__detail_name.Detail_Id')
            ->where("operation___detail__values.Operation_Type_Id","=",1)
            ->select('operation___detail__values.*','operation__detail_name.Operation_Detail_Name')
            ->get();
        $test=Operation__Detail_Value::all()->where("Operation_Type_Id","=",1);
            $values=$values->groupBy('Operation_Id');
//            return dd($values);

            foreach ($values as $t => $t1)
            {

                echo "<pre>";
                echo $t1;
                echo "<pre>";

            }
            return;

//            return $values[13][0]->email;


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

        return view('website.backend.database pages.Reservation_Show', ['values'=>$values,'sub_type' => $sub_types, 'main_type' => $main_types, 'property_detail' => $property_details,
         'property' => $property, 'data_type' => $data_type]);
    }
