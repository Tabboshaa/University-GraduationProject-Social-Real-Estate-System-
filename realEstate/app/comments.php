<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    protected $primaryKey='Comment_Id';
    protected $fillable = [
        'Post_Id',
        'User_Id',
        'Attachment_Id',
        'Comment'
    ];
}
