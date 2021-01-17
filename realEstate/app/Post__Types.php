<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post__Types extends Model
{
    //
    protected $primaryKey='Post_Type_Id';
    protected $fillable = [
        'Post_Id',
        'Post_Type_Name'
    ];
}
