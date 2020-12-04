<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $primaryKey='Country_Id';
    protected $fillable = ['Country_Name'];
}
