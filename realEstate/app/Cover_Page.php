<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cover_Page extends Model
{
    //
    protected $primaryKey='id';
    protected $fillable = [
        'Item_Id',
        'path'
    ];
}
