<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_Numbers extends Model
{
    //
    protected $primaryKey='PhoneNumber_Id';
    protected $fillable = [
        'User_ID',
        'phone_number',
        'Default'
    ];

    public function user(){
        return $this->hasOne(User::class, 'User_Id');
    }
}
