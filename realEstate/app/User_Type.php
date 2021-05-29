<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Type extends Model
{
    //
    protected $primaryKey='User_Type_ID';
    protected $fillable=[
        'Type_Name'
        ];

    public function useres(){
        return $this->hasMany(Type_Of_User::class, 'User_Type_ID');
    }
}
