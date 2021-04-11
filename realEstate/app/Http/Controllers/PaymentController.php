<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OperationsController;
use App\payment;
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
        // try {
            $Operation_Id = OperationsController::create();
            
            $payment=payment::create([
                'Operation_Id' => $Operation_Id,
                'Payment_Method'=> "Credit",
                'Card_Number'  => request('card-num'),
                'Paid_Amount'=> request('Country_Name'),
                'confirmed'=> request('Country_Name')
            ]);
<<<<<<< Updated upstream
            return back()->with('success','Payment Created Successfully');
        // }catch (\Illuminate\Database\QueryException $e){
        //     $errorCode = $e->errorInfo[1];
        //     if($errorCode == 1062){
        //         return back()->with('error','Payment Already Exist !!');
        //     }
        // }
=======
            return back()->with('success','City Created Successfully');
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with('error','City Already Exist !!');
            }//if($errorCode == 1048 ){
            //     return back()->with('error','You must select all values!!');
            // }
        }
>>>>>>> Stashed changes
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
        if(request()->has('id'))
       {
        try {
            payments::destroy($request->id);
        return redirect()->route('Card_Show')->with('success', 'Card Deleted Successfully');
    }catch (\Illuminate\Database\QueryException $e){

        return redirect()->route('Card_Show')->with('error', 'Card cannot be deleted');

    }
}else return redirect()->route('Card_Show')->with('warning', 'No Card was chosen to be deleted.. !!');
    }
    public function editPayment(Request $request)
    {
        try {

            //hygeb el country eli el ID bt3ha da
        $payment= payments::all()->find(request('Payment_Id'));
        //hy7ot el name el gded f column el country name
        $payment->Card_Number=request('Card_Num');
        $country->save();
                return back()->with('info','Card Edited Successfully');
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error','Error editing Card');
                }
            }

    }
}
