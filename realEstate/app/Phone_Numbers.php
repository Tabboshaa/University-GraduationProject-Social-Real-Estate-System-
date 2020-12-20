<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_Numbers extends Model
{
    //
    protected $fillable = [
        'User_ID',
        'phone_number',
        'Default'
    ];
}
