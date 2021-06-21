<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mymail extends Mailable
{
    use Queueable, SerializesModels;

    public $details,$item_name,$numberOfDays,$totalCost,$price_per_night,$start_date,$end_date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __constuct($details,$item_name,$numberOfDays,$totalCost,$price_per_night,$start_date,$end_date)
    {
        //
        $this->details = $details;
        $this->item_name = $item_name;
        $this->numberOfDays = $numberOfDays;
        $this->totalCost = $totalCost;
        $this->price_per_night = $price_per_night;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from Semsar.com')
            ->view('emails.MyMails');
    }
}
