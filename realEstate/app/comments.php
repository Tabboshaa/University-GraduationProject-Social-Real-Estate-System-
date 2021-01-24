<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    protected $primaryKey='Comment_Id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'Post_Id',
        'User_Id',
        'Attachment_Id',
        'Parent_Comment',
        'Comment'
    ];
}
