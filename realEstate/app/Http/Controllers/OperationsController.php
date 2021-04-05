<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\operations;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        // try {
            $operations=operations::create([
                'Item_Id' => request('item_id'),
                'User_Id'=> Auth::id()
            ]);
            return $operations->Operation_Id;
        // }catch (\Illuminate\Database\QueryException $e){
        //     $errorCode = $e->errorInfo[1];
        //     if($errorCode == 1062){
        //         return back()->with('error','Operation Already Exist !!');
        //     }if($errorCode == 1048 ){
        //         return back()->with('error','You must select all values!!');
        //     }
        // }
    
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

        $result = ($start_date->diffInDays($end_date)+1)*$price_per_night;
        $totalDays =($start_date->diffInDays($end_date)+1);
// return $result;//
return response()->json(['totalDays'=>$totalDays,'result'=>$result]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
