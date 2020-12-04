<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit_Cards extends Model
{
    //
    protected $fillable = [
        'Credit_Card_Id',
        'User_ID',
        'Default'
    ];
    
}
