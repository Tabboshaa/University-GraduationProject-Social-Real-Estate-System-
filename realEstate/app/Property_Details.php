<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_Details extends Model
{
    //
    

    protected $fillable = [
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Id',
        'DataType_Id',
        'Detail_Name'
    ];
}
