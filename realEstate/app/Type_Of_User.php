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

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id');
    }
    public function usertype()
    {
        return $this->belongsTo(User_Type::class, 'User_Type_ID');
    }
    public function getType(){
        $this->User_Type_ID;
    }
}
