<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    //
    protected $primaryKey='Payment_Id';
    protected $fillable = [
        'Operation_Id',
        'Payment_Method',
        'Card_Number',
        'Paid_Amount',
        'confirmed'
    ];
}
