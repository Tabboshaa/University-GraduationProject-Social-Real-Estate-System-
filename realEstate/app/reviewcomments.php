<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reviewcomments extends Model
{
    //
    protected $fillable = [
        'Review_Id',
        'path',
        'Item_Id'
    ];
}
