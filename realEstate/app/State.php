<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $primaryKey='State_Id';
    protected $fillable=['State_Name' ,'Country_Id'];
}
