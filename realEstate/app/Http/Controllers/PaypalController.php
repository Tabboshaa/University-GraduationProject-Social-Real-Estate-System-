<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{


    public function index($item_id, $schedule, $numberOfDays, $totalCost, $price_per_night, $start_date, $end_date){


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
        $redirectUrls->setReturnUrl(route('paypalReturn'))
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


    public function paypalReturn(){

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
            dd($result);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        }

    }
    public function paypalCancel(){

    }

}
