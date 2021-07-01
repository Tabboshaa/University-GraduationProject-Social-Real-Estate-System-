<?php

namespace App\Http\Controllers;

use App\Details;
use App\Item;
use App\Main_Type;
use App\Property_Details;
use App\Sub_Type;
use App\Sub_Type_Property;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetailsController extends Controller
{

    public function index()
    {

        $main_types = Main_Type::all();
        $sub_types = Sub_Type::all();
        $property = Sub_Type_Property::all();
        $property_details = Property_Details::all();
        $item = Item::all();
        //$subtype= get all sup type where main type id selected main  type
        return view('website.backend.database pages.Details', ['main_type' => $main_types, 'sub_type' => $sub_types, 'property_detail' => $property_details, 'item' => $item, 'property' => $property]);
    }

    public function create()
    {

        $detailsInput = request('data');
        $max = Details::max('Property_diff');
        $max += 1;

        foreach ($detailsInput as $detail) {
            $property_details = Property_Details::all()->where('Property_Detail_Id', '=', Arr::get($detail, 'id'))->first();

            if (Arr::get($detail, 'value') != null) {

            $details[] = [
                'Item_Id' => request('item_id'),
                'Main_Type_Id' => Arr::get($property_details, 'Main_Type_Id'),
                'Sub_Type_Id' => Arr::get($property_details, 'Sub_Type_Id'),
                'Property_Id' => Arr::get($property_details, 'Property_Id'),
                'property_Detail_Id' => Arr::get($property_details, 'Property_Detail_Id'),
                'Property_diff' => $max,
                'DetailValue' => Arr::get($detail, 'value')
            ];
        }

        }

        try {
           Details::insert($details);

           return $max;
        } catch (\Illuminate\Database\QueryException $e) {
         return null;
        }
        return null;
    }

    public function editDetails()
    {

        $detailsInput = request('DetailItem');


        foreach ($detailsInput as $detail) {

            try {
                $d = Details::all()->find(Arr::get($detail, 'id'));
                if ($d != null) {

                    if (Arr::get($detail, 'type') == 'checkbox') {


                        if (Arr::get($detail, 'value') == 'on') {
                            $val = 'yes';
                        } else {
                            $val = 'no';
                        }
                    } else if (Arr::get($detail, 'type') == 'file') {
                    } else {
                        $val = Arr::get($detail, 'value');
                    }

                    $d->DetailValue = $val;
                    $d->save();
                } else {
                    $propId = Arr::get($detail, 'id');
                    $propId = Str::replaceFirst('prop', '', $propId);
                    $property_details = Property_Details::all()->where('Property_Detail_Id', '=',  $propId)->first();
                    $val = Arr::get($detail, 'value');

                    Details::create(
                        [
                            'Item_Id' => request('item_id'),
                            'Main_Type_Id' =>  Arr::get($property_details, 'Main_Type_Id'),
                            'Sub_Type_Id' =>  Arr::get($property_details, 'Sub_Type_Id'),
                            'Property_Id' => Arr::get($property_details, 'Property_Id'),
                            'Property_Detail_Id' => Arr::get($property_details, 'Property_Detail_Id'),
                            'Property_diff' =>  Arr::get($detail, 'diff'),
                            'DetailValue' =>  $val
                        ]
                    );
                }

                return 'done';
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'Error editing Detail');
                }
                return back()->withError($e->getMessage())->withInput();
            }
        }
        //         return back()->with('info', 'Detail Edited Successfully');

    }


    public function AddImage()
    {
            return request()->all();
        // try {

        if ($files = request()->file('images')) {

            $property_details = Property_Details::all()->where('Property_Id', '=', request('detailimagepropertyid'))->first();

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('/profile gallery', $filename, 'public');

                $detail = Details::create(
                    [
                        'Item_Id' => request('detailimageitemid'),
                        'Main_Type_Id' =>  Arr::get($property_details, 'Main_Type_Id'),
                        'Sub_Type_Id' =>  Arr::get($property_details, 'Sub_Type_Id'),
                        'Property_Id' => request('detailimagepropertyid'),
                        'Property_Detail_Id' => 6,
                        'Property_diff' =>  request('detailimagediff'),
                        'DetailValue' =>   $filename
                    ]
                );
            }
        }

        return back()->with('success', 'Detail Added');

        //     } catch (\Illuminate\Database\QueryException $e) {
        //         $errorCode = $e->errorInfo[1];
        //         if ($errorCode == 1062) {
        //             return back()->with('error', 'Error editing Detail');
        //         }
        //         return back()->withError($e->getMessage())->withInput();

        // }
        //         return back()->with('info', 'Detail Edited Successfully');

    }

    public function show()
    {
        //
        $sub_types = Sub_Type::all();
        $main_types = Main_Type::all();
        $property = Sub_Type_Property::all();
        $property_details = Property_Details::all();
        $details = Details::all();
        $item = Item::all();
        return view('website.backend.database pages.Details_Show', ['sub_type' => $sub_types, 'main_type' => $main_types, 'property_detail' => $property_details, 'detail' => $details, 'item' => $item, 'property' => $property]);
    }
    public function edit()
    {
        //
        try {

            $detail = Details::all()->find(request('id'));
            $detail->DetailValue = request('DetailName');
            $detail->save();

            return back()->with('info', 'Detail Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Detail');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function destroy(Request $request)
    {
        //
        if (request()->has('id')) {
            try {
                Details::destroy($request->id);
                return redirect()->route('details_show')->with('success', 'Detail Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {

                return redirect()->route('details_show')->with('error', 'Detail cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('details_show')->with('warning', 'No Detail was chosen to be deleted.. !!');
    }


    public function destroydetail()
    {
        if (request()->has('id')) {
            try {
                Details::destroy(request('id'));
                
                return redirect()->back()->with('success', 'Detail Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                return back()->withError($e->getMessage())->withInput();
                return redirect()->back()->with('error', 'Detail cannot be deleted');
            }
        } else return redirect()->back()->with('warning', 'No Detail was chosen to be deleted.. !!');
    }

    public function destroydetails()
    {
        try {
            $d = Details::all()->where('Property_diff', '=', request('diff'));
            foreach ($d as $id) {
                Details::destroy($id->Detail_Id);
            }

            return $d;
        } catch (\Illuminate\Database\QueryException $e) {
            return;
        }
    }
    //to be deleted!!!
    public function findDetailsForShow()
    {
        // return  request('id');
        $details = DB::table('details')
            ->join('property__details', 'details.Property_Detail_Id', '=', 'property__details.Property_Detail_Id')
            ->select('details.*', 'property__details.Detail_Name')
            ->get()->where('Property_diff', '=', request('id'));


        // Details::all()->where('Property_diff','=',request('id'));

        return $details;
    }
}
