<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Type_Contents extends Model
{
    //
    protected $primaryKey='Post_Type_Contents_Id';
    protected $fillable = [
        'Post_Id',
        'Post_Type_Id',
        'Post_Type_Content_Name'
    ];
}
