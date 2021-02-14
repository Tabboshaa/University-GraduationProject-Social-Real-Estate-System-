<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        return view('website.backend.database pages.Item_Schedule',['item_id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        try {
            Schedule::create([
                'Item_Id' => $id,
                'Start_Date' => request('arrival'),
                'End_Date' => request('departure'),
                'Price_Per_Night' => request('price'),
            ]);
            return back()->with('success', 'Schedule Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating schedule !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $schedule= Schedule::select()->where('Item_Id','=',$id)->paginate(10);
        return view('website.backend.database pages.Item_Schedule_Show',['schedules'=>$schedule,'item_id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        try {
            $schedule = Schedule::all()->find(request('id'));
            $schedule->Start_Date = request('StartDate');
            $schedule->End_Date = request('EndDate');
            $schedule->Price_Per_Night = request('Price');
            $schedule->save();
            return back()->with('info','Schedule Edited Successfully');
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with('error','Error editing Schedule');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        if(request()->has('schedule'))
        {

         try {
         Schedule::destroy(request('schedule'));

         return redirect()->back()->with('success', 'Schedule Deleted Successfully');
     }catch (\Illuminate\Database\QueryException $e){

         return redirect()->back()->with('error', 'Schedule cannot be deleted');

     }
     }else return redirect()->back()->with('warning', 'No Schedule was chosen to be deleted.. !!');

    }
}
