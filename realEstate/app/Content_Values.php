<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_Values extends Model
{
    //
    protected $primaryKey='Content_Values_Id';
    protected $fillable = [
        'Post_Id',
        'Post_Type_Id',
        'Post_Type_Contents_Id',
        'Content_Value_Name'
    ];
}
