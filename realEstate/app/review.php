<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $primaryKey='Review_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id',
        'Review_Title',
        'Review_Content',
        'Number_Of_Stars'
    ];
}
