<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    //
    protected $primaryKey='Photo_Id';
    protected $fillable = [
        'User_Id',
        'Profile_Picture'
    ];
}
