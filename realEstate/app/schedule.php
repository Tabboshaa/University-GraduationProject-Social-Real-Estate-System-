<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $primaryKey='schedule_Id';
    protected $fillable = [
        'Item_Id',
        'Start_Date',
        'End_Date',
        'Price_Per_Night'
    ];
}
