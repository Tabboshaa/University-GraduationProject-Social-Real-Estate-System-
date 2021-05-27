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
}
