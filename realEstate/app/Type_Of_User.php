<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Of_User extends Model
{
    //
    protected $fillable = [
        'User_ID',
        'User_Type_ID'
    ];
}
