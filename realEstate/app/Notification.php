<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $primaryKey = 'Notification_Id';
    protected $fillable = [
        'User_Id',
        'Notification',
        'Redirect_To',
        'Viewed'
    ];
}
