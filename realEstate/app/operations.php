<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operations extends Model
{
    //
    protected $primaryKey='Operation_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id'
    ];
}
