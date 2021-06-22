<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

use App\Emails;
use App\Item;

class PaypalController extends Controller
{

    public function create($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date)
    {
        //return dd($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date);

        try{
            //create reservation
            $Operation_Id = OperationsController::create($item_id,1);

            //create reservation details
            OperationsController::createValue($Operation_Id, 1, 1, $price_per_night);
            OperationsController::createValue($Operation_Id, 1, 2, $start_date);
            OperationsController::createValue($Operation_Id, 1, 3, $end_date);
            OperationsController::createValue($Operation_Id, 1, 4, $totalCost);
            $flag = ScheduleController::cutSchedule($schedule,$start_date ,$end_date);
            //create payment
            $payment = \App\payment::create([
                'Operation_Id' => $Operation_Id,
                'Payment_Method' => "Credit",
                'Paid_Amount' => $totalCost,
                'confirmed' => 1,
            ]);
            $this->sendDoneMail($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date);
            return redirect()->route('user_reservations')->with('success', 'Created Successfully');
        }catch(Exception $e){
            return back()->with('error', 'Error creating');
        }

    }


    public function index($itemId=null, $schedule=null, $numberOfDays=null, $totalCost=null, $pricePerNight=null, $startDate=null, $endDate=null){


        if($itemId==null){

            $itemId=\request('itemid');
            $schedule=\request('schedule');
            $numberOfDays=\request('numberOfDays');
            $totalCost=\request('totalCost');
            $pricePerNight=\request('pricePerNight');
            $startDate=\request('startDate');
            $endDate=\request('endDate');
        }
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AVC3OItZqKXxpU7LUbFL8XTFVd2NgeBn_HYeieeXHll2JsUM9ucD3mqMoHDjrS8nSaxjcGyvzU9YW5-h',// ClientID
                'EOmoczfN7FDwMp146lsFjb8zALzwojG1l2BpdDXphwquVI2j7hoyat7E8gUnojpuLuDLWFazdficMsXP'      // ClientSecret
            )
        );

        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');
        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('111');
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypalReturn',[$itemId, $schedule, $numberOfDays, $totalCost, $pricePerNight, $startDate, $endDate]))
            ->setCancelUrl("https://example.com/your_cancel_url.html");

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";

            return redirect($payment->getApprovalLink());
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }


    public function paypalReturn($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date){

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AVC3OItZqKXxpU7LUbFL8XTFVd2NgeBn_HYeieeXHll2JsUM9ucD3mqMoHDjrS8nSaxjcGyvzU9YW5-h',// ClientID
                'EOmoczfN7FDwMp146lsFjb8zALzwojG1l2BpdDXphwquVI2j7hoyat7E8gUnojpuLuDLWFazdficMsXP'      // ClientSecret
            )
        );
        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

// Execute payment with payer ID
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            // Execute payment
            $result = $payment->execute($execution, $apiContext);
            return $this->create($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date);

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        }

    }
    public function paypalCancel(){

    }

    public function sendDoneMail($item_id=null, $schedule=null, $numberOfDays=null, $totalCost=null, $price_per_night=null, $start_date=null, $end_date=null){

        $user_id=Auth::id();
        $email=Emails::all()->where('User_ID', '=', $user_id)->first()->email;
        $item_name=Item::all()->where('Item_Id', '=', $item_id)->first()->Item_Name;
        $details = [
            'title' => 'Mail from Semsar.com',
            'body' => 'The rental process has been completed successfully!! ,',
            'Link'=>'Please Rate Us'
        ];
        \Mail::to('abdalaziztabbosha@gmail.com')->send(new \App\Mail\Mymail($details,$item_name,$numberOfDays,$totalCost,$price_per_night,$start_date,$end_date));
    }

}
