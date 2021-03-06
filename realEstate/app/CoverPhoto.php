<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverPhoto extends Model
{
    //
    protected $primaryKey='Photo_Id';
    protected $fillable = [
        'User_Id',
        'Cover_Photo'
    ];
    public function user(){
        return $this->hasOne(User::class, 'User_Id');
    }
}
