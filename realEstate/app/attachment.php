<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attachment extends Model
{
    //
    protected $primaryKey='Attachment_Id';
    protected $fillable = [
        'File_Path'
    ];
}
