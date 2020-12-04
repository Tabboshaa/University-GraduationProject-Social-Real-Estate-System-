<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $primaryKey='City_Id';
    protected $fillable = ['City_Name', 'State_Id', 'Country_Id'];
}
