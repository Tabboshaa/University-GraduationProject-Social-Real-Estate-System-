<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\operations;
use App\operation__types;
use App\Operation__Detail_Name;
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
        return view('website\backend.database pages.Operation_Detail', ['operation' => $operationType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        
        try {
            $operations=operations::create([
                'Item_Id' => 1,
                'User_Id'=> Auth::id()
            ]);
            return $operations->Operation_Id;
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with('error','City Already Exist !!');
            }if($errorCode == 1048 ){
                return back()->with('error','You must select all values!!');
            }
        }
    
    }
    public static function createType()
    {
    try {
        $operation_Type = operation__types::create([
            'Operation_Name' => request('Operation_Type_Name'),
        ]);
        return back()->with('success','type Created Successfully');
    }catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return back()->with('error','Already Exist !!');
        }
    }
}
public static function createDetail()
{

     try {
        $operation_Detail = Operation__Detail_Name::create([
            'Operation_Detail_Name' => request('Operation_Detail'),
            'Operation_Type_Id' => request('operation_Name')

        ]);
        return back()->with('success', 'Detail Created Successfully');
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            return back()->with('error', 'Detail Already Exists !!');
        }
        if ($errorCode == 1048) {
            return back()->with('error', 'You must select all values!!');
        }
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
        $schedule=request('schedule_Id');
        $price_per_night=Schedule::all()->where('schedule_Id', '=', $schedule)->first()->Price_Per_Night;
        $start_date=new \Carbon\Carbon(request('start'));
        $end_date=new \Carbon\Carbon(request('end'));

        $result = ($start_date->diffInDays($end_date)+1)*$price_per_night;
        $totalDays =($start_date->diffInDays($end_date)+1);
// return $result;//
return view('website.frontend.customer.Reservation',['totalDays'=>$totalDays,'Result'=>$result]);
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
  $operation_types=Operation__types::paginate(10);
  return view('website.backend.database pages.operation_Types_Show',['operation_types1'=>$operation_types]);

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
     public function getDetailById($id)
     {
         $operationDetail = Operation__Detail_Name::all()->find($id);
         //return dd($subtype) ;
         return response()->json($operationDetail);
     }
    public function edit()
    {
        try {
            $operation_types=Operation__types::all()->find(request('id'));
            $operation_types->Operation_Name=request('OperationTypeName');
            $operation_types->save();

                return back()->with('info','Item Edited Successfully');
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error','Error editing item');
                }
            }
    }
    public function editDetail()
    {
        try {

            //hygeb el country eli el ID bt3ha da
            $operation_detail = Operation__Detail_Name::all()->find(request('id'));
            //hy7ot el name el gded f column el country name
            $operation_detail->Operation_Detail_Name = request('operation_Detail');
            $operation_detail->save();

            //hyb3t el update el gded fl country table
            return back()->with('info', 'State Edited Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing item');
            }
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
        $details = Operation__Detail_Name::all();
        $operation_names = Operation__types::all();
        $detail = Operation__Detail_Name::all()->find($id);
        $subtype->Operation_Type_Id = request('OperationName');
        $subtype->Operation_Detail_Name = request('OperationDetail');


        $subtype->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(request()->has('operationType'))
        {
         try {
            Operation__types::destroy($request->operationType);
         return redirect()->route('operation_types_show')->with('success', 'operation Deleted Successfully');
     }catch (\Illuminate\Database\QueryException $e){
         return redirect()->route('operation_types_show')->with('error', 'operation cannot be deleted');
                 
     }
 }else return redirect()->route('operation_types_show')->with('warning', 'No type was chosen to be deleted.. !!');
 }
 public function destroyDetail(Request $request , $id=null)
    {
        // Will Destroy each column with id form action
        if (request()->has('id')) {
            try {
                Operation__Detail_Name::destroy($request->id);
                return redirect()->route('detailop_show')->with('success', 'Detail Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {

                return redirect()->route('detailop_show')->with('error', 'Detail cannot be deleted');
            }
        } else return redirect()->route('detailop_show')->with('warning', 'No Delete was chosen to be deleted.. !!');
    }
    
    public function showDetail()
    {
        //
        $operation_detail = DB::table('Operation__Detail_Name')->join('Operation__types', 'Operation__Detail_Name.Operation_Type_Id', '=', 'Operation__types.Operation_Type_Id')
        ->select('Operation__Detail_Name.*', 'Operation__types.Operation_Type_Id')->paginate(10);
    //DB join b3ml add l column el main type name le table el subtype w bb3to 3sha azhr el main type name
    //fe table el show sub tye
    $operation_name = Operation__Detail_Name::paginate(10);
    return view('website.backend.database pages.Operation_Detaiols_show', ['Detail1' => $detail_show, 'op_Detail' => $op_Details]);  }
    }

