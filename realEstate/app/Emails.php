<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    //
    protected $primaryKey='Email_Id';
    protected $fillable = [
        'User_ID',
        'email',
        'Default'
    ];
    public function user(){
        return $this->hasOne(User::class, 'User_Id');
    }
}
