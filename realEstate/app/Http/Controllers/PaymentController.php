<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OperationsController;
use App\Operation__Detail_Value;
use App\payment;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
    public function create()
    {
        DB::beginTransaction();
        try{
            //create reservation
        $Operation_Id = OperationsController::create(request('item_id'));
        //create reservation details
        OperationsController::createValue($Operation_Id, 1, 1, request('price_per_night'));
        OperationsController::createValue($Operation_Id, 1, 2, request('start_date'));
        OperationsController::createValue($Operation_Id, 1, 3, request('end_date'));
        OperationsController::createValue($Operation_Id, 1, 4, request('totalCost'));
        $flag = ScheduleController::cutSchedule(request('schedule'), request('start_date'), request('end_date'));
        //create payment
        $payment = payment::create([
            'Operation_Id' => $Operation_Id,
            'Payment_Method' => "Credit",
            'Card_Number'  => request('card-num'),
            'Paid_Amount' => request('totalCost'),
            'confirmed' => 1,
        ]);
        DB::commit();
        return back()->with('success', 'Created Successfully');
    }catch(Exception $e){
        DB::rollBack();
            return back()->with('error', 'Error creating');
            return back()->withError($e->getMessage())->withInput();
        }
        
    }
    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_payment($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date)
    {
        try{
        // //{totalCost}/{price_per_night}/{start_date}/{end_date}
        return view('website.frontend.customer.Reservation', ['schedule' => $schedule, 'totalCost' => $totalCost, 'numberOfDays' => $numberOfDays, 'item_id' => $item_id, "price_per_night" => $price_per_night, "start_date" => $start_date, "end_date" => $end_date]);
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();
    }
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

    public function destroy(Request $request)
    {
        // Will Destroy each column with id form action
        if (request()->has('id')) {
            DB::beginTransaction();
            
            try {
                payment::destroy($request->id);
                DB::commit();
                return redirect()->route('Card_Show')->with('success', 'Card Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withError($e->getMessage())->withInput();
                return redirect()->route('Card_Show')->with('error', 'Card cannot be deleted');
            }
        } else
            return redirect()->route('Card_Show')->with('warning', 'No Card was chosen to be deleted.. !!');
    }
    public function editPayment(Request $request)
    {
        DB::beginTransaction();
        
        try {
            
            //hygeb el country eli el ID bt3ha da
            $payment = payment::all()->find(request('Payment_Id'));
            //hy7ot el name el gded f column el country name
            $payment->Card_Number = request('Card_Num');
            $payment->save();
            DB::commit();
            return back()->with('info', 'Card Edited Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Card');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
