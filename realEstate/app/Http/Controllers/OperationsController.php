<?php

namespace App\Http\Controllers;

use App\Item;
use App\Schedule;
use Illuminate\Http\Request;
use App\operations;
use App\operation__types;
use App\Operation__Detail_Name;
use App\Operation__Detail_Value;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operationType = operation__types::all();
        return view('website\backend.database pages.Operation_Detail', ['Operation__types' => $operationType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($item_Id)
    {
        DB::beginTransaction();
        try {
            $operations = operations::create([
                'Item_Id' => $item_Id,
                'User_Id' => Auth::id()

            ]);
            DB::commit();
            return $operations->Operation_Id;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'City Already Exist !!');
            }
            if ($errorCode == 1048) {
                return back()->with('error', 'You must select all values!!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public static function createType()
    {
        DB::beginTransaction();
        try {
            $operation_Type = operation__types::create([
                'Operation_Name' => request('Operation_Type_Name'),
            ]);
            DB::commit();
            return back()->with('success', 'type Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Already Exist !!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public static function createDetail()
    {
        DB::beginTransaction();
        try {
            $operation_Detail = Operation__Detail_Name::create([
                'Operation_Detail_Name' => request('Operation_Detail'),
                'Operation_Type_Id' => request('operation_Name')

            ]);
            DB::commit();
            return back()->with('success', 'Detail Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Detail Already Exists !!');
            }
            if ($errorCode == 1048) {
                return back()->with('error', 'You must select all values!!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public static function createValue($Operation_Id, $Type_Id, $Detail_Id, $Value)
    {
        DB::beginTransaction();
        try {
            $reservation = Operation__Detail_Value::create(
                [
                    'Operation_Id' => $Operation_Id,
                    'Operation_Type_Id' => $Type_Id,
                    'Detail_Id' => $Detail_Id,
                    'Operation_Detail_Value' => $Value,
                ]
            );


            DB::commit();
            return back()->with('success', 'Detail Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Detail Already Exists !!');
            }
            if ($errorCode == 1048) {
                return back()->with('error', 'You must select all values!!');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculateDays()
    {
        //
        $schedule = request('schedule_Id');

        $price_per_night = Schedule::all()->where('schedule_Id', '=', $schedule)->first()->Price_Per_Night;
        $start_date = new \Carbon\Carbon(request('start'));
        $end_date = new \Carbon\Carbon(request('end'));

        $totalPrice = ($start_date->diffInDays($end_date) + 1) * $price_per_night;
        $totalDays = ($start_date->diffInDays($end_date) + 1);
        // return $result;//
        // return redirect()->jason(['totalDays'=>$totalDays,'Result'=>$result]);
        return (['totalPrice' => $totalPrice, 'totalDays' => $totalDays, "price_per_night" => $price_per_night, "start_date" => $start_date, "end_date" => $end_date]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $operation_types = Operation__types::paginate(10);
        return view('website.backend.database pages.operation_Types_Show', ['operation_types' => $operation_types]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finddetail()
    {

        $operationDetail = Operation__Detail_Name::all()->where('Operation_Type_Id', '=', request('id'));

        return  response()->json($operationDetail);
    }

    public function edit()
    {
        DB::beginTransaction();
        
        try {
            $operation_types = Operation__types::all()->find(request('id'));
            $operation_types->Operation_Name = request('OperationTypeName');
            $operation_types->save();
            
            DB::commit();
            return back()->with('info', 'Item Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
        DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing item');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function editDetail()
    {

        DB::beginTransaction();
        
        try {
            
            
            $operation_detail = Operation__Detail_Name::all()->find(request('id'));
            
            $operation_detail->Operation_Detail_Name = request('operation_det');
            $operation_detail->save();
            
            
            DB::commit();
            return back()->with('info', 'Operation Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing item');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (request()->has('operationType')) {
            DB::beginTransaction();
            try {
                Operation__types::destroy($request->operationType);
                DB::commit();
                return redirect()->route('operation_types_show')->with('success', 'operation Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return redirect()->route('operation_types_show')->with('error', 'operation cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('operation_types_show')->with('warning', 'No type was chosen to be deleted.. !!');
    }
    public function destroyDetail(Request $request, $id = null)
    {
        // Will Destroy each column with id form action
        if (request()->has('id')) {
            DB::beginTransaction();
            
            try {
                Operation__Detail_Name::destroy($request->id);
                DB::commit();
                return redirect()->route('detailop_show')->with('success', 'Detail Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {                
                DB::rollBack();
                return redirect()->route('detailop_show')->with('error', 'Detail cannot be deleted');
                return back()->withError($e->getMessage())->withInput();
            }
        } else return redirect()->route('detailop_show')->with('warning', 'No Delete was chosen to be deleted.. !!');
    }

    public function showDetail()
    {

        $operationname = operation__types::all();
        $operationDetailName = DB::table('operation__detail_name')
            ->join('operation__types', 'operation__detail_name.Operation_Type_Id', '=', 'operation__types.Operation_Type_Id')
            ->select('operation__detail_name.*', 'operation__types.Operation_Name')->paginate(10);

        return view('website\backend.database pages.Operation_Details_show', ['Detail1' => $operationDetailName, 'Operation__types' => $operationname]);
    }

    //show reservations for an item in admin
    public function showreservations($item_id)
    {
        $item = Item::all()->where('Item_Id', '=', $item_id)->first();

        return view('website.backend.database pages.Reservation_Show', ['item' => $item]);
    }
    public function showuserreservations()
    {

        $user = Auth::user();
        $operations = $user->operations;
        return view('website.frontend.customer.ShowReservation', ['operations' => $operations]);
    }
    //delete operation
    public function destroyOperation($id)
    {
        DB::beginTransaction();
        
        try {
            operations::destroy($id);
            DB::commit();
            return redirect()->back()->with('success', 'operation Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'operation cannot be deleted');
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
