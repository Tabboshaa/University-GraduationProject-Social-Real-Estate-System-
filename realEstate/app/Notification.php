<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $primaryKey = 'Notification_Id';
    protected $fillable = [
        'To_User_Id',
        'From_User_Id',
        'Notification',
        'Redirect_To',
        'Viewed'
    ];
}
