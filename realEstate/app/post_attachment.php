<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_attachment extends Model
{
    //
    protected $fillable = [
        'Post_Id',
        'Attachment_id',
        'Item_ld'
    ];
}
