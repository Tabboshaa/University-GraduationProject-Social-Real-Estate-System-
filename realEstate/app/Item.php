<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $primaryKey='Item_Id';

    protected $fillable=[
        'Street_Id',
        'User_Id',
        'Item_Name'
    ];

}
