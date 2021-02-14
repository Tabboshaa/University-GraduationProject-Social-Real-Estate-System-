<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    //
    protected $primaryKey='reservation_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id'];
}
