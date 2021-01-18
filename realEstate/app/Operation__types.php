<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation__types extends Model
{
    //
    protected $primaryKey='Operation_Type_Id';
    protected $fillable = [
        'Operation_Id',
        'Operation_Name'
    ];
}
