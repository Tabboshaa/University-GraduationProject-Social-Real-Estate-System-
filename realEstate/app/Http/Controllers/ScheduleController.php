<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function create($id = null)
    {
        //check if date exists
        if ((ScheduleController::checkIfScheduleExists($id, request('arrival')) && ScheduleController::checkIfScheduleExists($id, request('departure'))))
            return back()->with('error',  "both your start and end dates coincides with a previous schedule");
        else if (ScheduleController::checkIfScheduleExists($id, request('arrival')))
            return back()->with('error',  "your start date coincides with a previous schedule");
        else if (ScheduleController::checkIfScheduleExists($id, request('departure')))
            return back()->with('error', "your end date coincides with a previous schedule");

        DB::beginTransaction();
        try {
            if ($id == null) {
                $id = request('id');
            }
            $test = Schedule::create([
                'Item_Id' => $id,
                'Start_Date' => request('arrival'),
                'End_Date' => request('departure'),
                'Price_Per_Night' => request('price')
            ]);
            DB::commit();
            return back()->with('success', 'Schedule Created Successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
            return back()->with('error', 'Error creating schedule !!');
        }
    }

    public function Ownercreate()
    {
        //check if date exists
        if (ScheduleController::checkIfScheduleExists(request('id'), request('arrival')) && ScheduleController::checkIfScheduleExists(request('id'), request('departure')))
            return ["message" => "Both your start and end dates coincides with a previous schedule", "class" => "alert alert-danger alert-block"];
        else if (ScheduleController::checkIfScheduleExists(request('id'), request('arrival')))
            return ["message" => "Your start date coincides with a previous schedule", "class" => "alert alert-danger alert-block"];
        else if (ScheduleController::checkIfScheduleExists(request('id'), request('departure')))
            return ["message" => "Your end date coincides with a previous schedule", "class" => "alert alert-danger alert-block"];

        DB::beginTransaction();
        try {
            $test = Schedule::create([
                'Item_Id' => request('id'),
                'Start_Date' => request('arrival'),
                'End_Date' => request('departure'),
                'Price_Per_Night' => request('price')
            ]);

            DB::commit();
            return ["message" => "Schedule Added successfully", "class" => "alert alert-success alert-block"];
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return ["message" => "Sorry, An error happened creating your schedule.", "class" => "alert alert-danger alert-block"];
        }
    }

    //used in cut schedule function
    public static function createWithVriables($id, $start, $end, $price)
    {
        //
        //check if date exists
        if (ScheduleController::checkIfScheduleExists($id, $start) && ScheduleController::checkIfScheduleExists($id, $end))
            return "both your start and end dates coincides with a previous schedule";
        else if (ScheduleController::checkIfScheduleExists($id, $start))
            return "your start date coincides with a previous schedule";
        else if (ScheduleController::checkIfScheduleExists($id, $end))
            return "your end date coincides with a previous schedule";

        DB::beginTransaction();
        try {
            Schedule::create([
                'Item_Id' => $id,
                'Start_Date' => $start,
                'End_Date' => $end,
                'Price_Per_Night' => $price,
            ]);
            DB::commit();
            return;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
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

        $schedule = DB::table("schedules")
            ->selectRaw('schedule_Id,Start_Date,YEAR(Start_Date) as year ,MONTH(Start_Date) as month,End_Date')
            ->where("Item_Id","=",$item_id)
            ->orderBy('Start_Date')
            ->get();

        $days = [];
        //get day of every schedule
        foreach ($schedule as $value) {

            $day = ScheduleController::getdays($value->Start_Date, $value->End_Date, $value->schedule_Id);
            //merge days
            $days = collect($days)->merge($day)->unique(); //unique 3shan mykrrsh date mrten
        }

        //group by month of date
        $days = collect($days)->groupBy([function ($val) {
            return Carbon::parse($val['date'])->format('Y');
        }, function ($val) {
            return Carbon::parse($val['date'])->format('m');
        }])->toArray();

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
        if (!Carbon::parse($start)->isPast()) {
            $interval[] = [
                'date' => $start,
                'schedule_Id' => $schedule_id
            ];
        }
        // }for loop to store interval in array
        foreach ($period as $key => $value) {

            if (!Carbon::parse($value)->isPast()) {
                $interval[] = [
                    'date' => $value->format('Y-m-d'),
                    'schedule_Id' => $schedule_id
                ];
            }
        }
        //enter end date
        if (!Carbon::parse($end)->isPast()) {
            $interval[] = [
                'date' => $end,
                'schedule_Id' => $schedule_id
            ];
        }
        return $interval;
    }

    public static function cutSchedule($schedule_id, $start, $end)
    {
        //schdule 01/03/2020 to 20/03/2020
        DB::beginTransaction();
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
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
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
        DB::beginTransaction();
        
        try {
            $schedule = Schedule::all()->find(request('id'));
            $schedule->Start_Date = request('StartDate');
            $schedule->End_Date = request('EndDate');
            $schedule->Price_Per_Night = request('Price');
            $schedule->save();
            
            DB::commit();
            request()->session()->flash('info', 'Schedule Edited Successfully');
            return ('/owneritemManageSchedule/' . $schedule->Item_Id);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Schedule');
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
    public static function checkIfScheduleExists($item, $start,$end=null)
    {
        //
        if($end)
        {
            
        $tst = DB::table("schedules")->where('Item_Id', '=', $item)
        ->whereDate('schedules.Start_Date', '<=', $start)
        ->whereDate('schedules.End_Date', '>=', $end)->get();

    }else{
        
        $tst = DB::table("schedules")->where('Item_Id', '=', $item)
            ->whereDate('schedules.Start_Date', '<=', $start)
            ->whereDate('schedules.End_Date', '>=', $start)->get();
        }
        if ($tst == '[]') return false;

        return true;
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
            DB::beginTransaction();
            
            try {
                Schedule::destroy(request('schedule'));
                
                DB::commit();
                return redirect()->back()->with('success', 'Schedule Deleted Successfully');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
                return redirect()->back()->with('error', 'Schedule cannot be deleted');
            }
        } else if ($id != null) {
            try {
            Schedule::destroy($id);
            return "schedule done";
            }catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return 'Schedule cannot be deleted';
            }
        } else return redirect()->back()->with('warning', 'No Schedule was chosen to be deleted.. !!');
    }
}
