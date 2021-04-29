<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State_Photo extends Model
{
    //
    public $table ="state_photos";

    protected $primaryKey='photo_id';
    protected $fillable = [
        'Attachment_Id',
        'State_Id'
    ];
    
}
