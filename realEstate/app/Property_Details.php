<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_Details extends Model
{
    //
    protected $primaryKey='Property_Detail_Id';

    protected $fillable = [
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Id',
        'DataType_Id',
        'Detail_Name'
    ];
}
