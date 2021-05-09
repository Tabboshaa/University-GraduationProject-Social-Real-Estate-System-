<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Contracts\Session\Session;
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
        return view('website.backend.database pages.Item_Schedule', ['item_id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        try {     
           $test= Schedule::create([
                'Item_Id' => $id,
                'Start_Date' => request('arrival'),
                'End_Date' => request('departure'),
                'Price_Per_Night' => request('price'),
                ]);
                return;
            } catch (\Illuminate\Database\QueryException $e) {
    
                return back()->with('error', 'Error creating schedule !!');
            }
        
    }

    public static function createWithVriables($id, $start, $end, $price)
    {
        //
        try {
            Schedule::create([
                'Item_Id' => $id,
                'Start_Date' => $start,
                'End_Date' => $end,
                'Price_Per_Night' => $price,
            ]);
            return;
        } catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Error creating schedule !!');
        }
    }

    public static function getWholeSchedule($item_id)
    {
        //     get from Schedule endDate startDate where item id =$item_id

        $schedule = schedule::orderBy('Start_Date')->where('Item_Id', '=', $item_id)->get();

        return $schedule;
    }
    public static function getAvailableTime($item_id)
    {
        //     get from Schedule endDate startDate where item id =$item_id

        $schedule = schedule::orderBy('Start_Date')->where('Item_Id', '=', $item_id)->get();

        $days = [];
        //get day of every schedule
        foreach ($schedule as $value) {

            $day = ScheduleController::getdays($value->Start_Date, $value->End_Date, $value->schedule_Id);
            //merge days
            $days = collect($days)->merge($day)->unique(); //unique 3shan mykrrsh date mrten
        }

        //group by month of date
        $days = collect($days)->groupBy(function ($val) {
            return Carbon::parse($val['date'])->format('m');
        })->toArray();

        return $days;
    }

    public static function getdays($start, $end, $schedule_id)
    {

        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );

        $interval = [];
        //enter start date
        $interval[] = [
            'date' => $start,
            'schedule_Id' => $schedule_id
        ];

        // }for loop to store interval in array
        foreach ($period as $key => $value) {
            $interval[] = [
                'date' => $value->format('Y-m-d'),
                'schedule_Id' => $schedule_id
            ];
        }
        //enter end date
        $interval[] = [
            'date' => $end,
            'schedule_Id' => $schedule_id
        ];

        return $interval;
    }

    public static function cutSchedule($schedule_id, $start, $end)
    {
        //schdule 01/03/2020 to 20/03/2020
        try {
            $schedule = Schedule::all()->find($schedule_id);
            if ($start ==  $schedule->Start_Date) { //if chosen date starts with the first day of schedule, customer chose 01/03/2020 to 20/03/2020
                if ($end ==  $schedule->End_Date) { // check if it also ends with the same date of schedule, if it does then customer reserved the whole schedule
                    ScheduleController::destroy($schedule_id); // then delete taken schedule
                }
            } else if ($end ==  $schedule->End_Date) { //if it doesn't start with start date check if customer depart on end day, customer chose 15/03/2020 to 20/03/2020
                return $start = date('Y-m-d', strtotime('-1 day', strtotime($start))); // minus customer start one day to be you new end date for your new schedule
                ScheduleController::createWithVriables($schedule->Item_Id, $schedule->Start_Date, $start, $schedule->Price_Per_Night);
                ScheduleController::destroy($schedule_id);
            } else { //customer chose 15/03/2020 to 17/03/2020
                $start = date('Y-m-d', strtotime('-1 day', strtotime($start))); //14/03/2020
                $end =  date('Y-m-d', strtotime('+1 day', strtotime($end))); //18/03/2020
                 // create schedule from 01/03/2020 to 14/03/2020
                ScheduleController::createWithVriables($schedule->Item_Id, $schedule->Start_Date, $start, $schedule->Price_Per_Night);
               //createschedule from 18/03/2020 to 20/03/2020
                ScheduleController::createWithVriables($schedule->Item_Id, $end, $schedule->End_Date, $schedule->Price_Per_Night); 
                //delete old schedule 
                ScheduleController::destroy($schedule_id);
            }
            return true;
        } catch (Exception $e) {
            return false;
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
        $schedule = Schedule::select()->where('Item_Id', '=', $id)->paginate(10);
        return view('website.backend.database pages.Item_Schedule_Show', ['schedules' => $schedule, 'item_id' => $id]);
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
            request()->session()->flash('info', 'Schedule Edited Successfully');
            return ('/owneritemManageSchedule/' . $schedule->Item_Id);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Schedule');
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
    public static function destroy($id = null)
    {
        //
        if (request()->has('schedule')) {

            try {
                Schedule::destroy(request('schedule'));

                return redirect()->back()->with('success', 'Schedule Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {

                return redirect()->back()->with('error', 'Schedule cannot be deleted');
            }
        } else if ($id != null) {
            Schedule::destroy($id);
            return "schedule done";
        } else return redirect()->back()->with('warning', 'No Schedule was chosen to be deleted.. !!');
    }
}
