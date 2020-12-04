<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $primaryKey='Region_Id';
    protected $fillable=['Region_Name' , 'City_Id' , 'State_Id' , 'Country_Id'];
}
