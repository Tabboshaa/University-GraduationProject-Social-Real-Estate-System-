<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    //
    protected $primaryKey='Post_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id',
        'Post_Title',
        'Post_Content'
    ];
}
