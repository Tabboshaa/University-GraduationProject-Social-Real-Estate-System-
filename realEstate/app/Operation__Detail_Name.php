<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation__Detail_Name extends Model
{
    //
    protected $table = 'operation___detail__names';
    protected $primaryKey='Detail_Id';
    protected $fillable = [
        'Operation_Id',
        'Operation_Type_Id',
        'Operation_Detail_Name'
    ];

}
