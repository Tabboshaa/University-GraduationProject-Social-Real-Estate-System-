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
    public function touser(){
        return $this->hasOne(User::class, 'To_User_Id');
    }
    public function fromuser(){
        return $this->hasOne(User::class, 'From_User_Id');
    }
}
