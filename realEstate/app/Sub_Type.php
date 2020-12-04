<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Type extends Model
{
    //
    protected $primaryKey='Sub_Type_Id';
    
    protected $fillable = [
        'Main_Type_Id',
        'Sub_Type_Name'
    ];
}
