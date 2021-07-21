<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reviewcomments extends Model
{
    protected $primaryKey='Comment_Id';
    //
    protected $fillable = [
        'Post_Id',
        'User_Id',
        'Parent_Comment',
        'Comment'
    ];
}
