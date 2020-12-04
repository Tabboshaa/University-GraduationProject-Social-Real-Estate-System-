<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    //
    protected $fillable = [
        'User_ID',
        'email',
        'Default'
    ];
}
