<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    //
    protected $primaryKey='Street_Id';
    protected $fillable=['Street_Name','Region_Id' , 'City_Id' , 'State_Id' , 'Country_Id'];
}
