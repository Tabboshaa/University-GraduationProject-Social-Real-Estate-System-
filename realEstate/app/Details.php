<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    //
    protected $primaryKey='Detail_Id';
    protected $fillable = [
        'Item_Id',
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Id',
        'Property_Detail_Id',
        'DetailValue'
    ];
}
