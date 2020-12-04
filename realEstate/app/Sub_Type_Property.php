<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Type_Property extends Model
{
    //
    protected $primaryKey='Property_Id';
    protected $fillable = [
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Name'
    ];
}
