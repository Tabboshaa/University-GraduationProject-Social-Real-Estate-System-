<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation__Detail_Value extends Model
{
    //
    protected $primaryKey='Value_Id';
    protected $fillable = [
        'Operation_Id',
        'Operation_Type_Id',
        'Detail_Id',
        'Operation_Detail_Value'
    ];
}
