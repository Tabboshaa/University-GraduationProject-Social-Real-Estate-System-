<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followeditemsbyuser extends Model
{
    //
    
    protected $primaryKey='Followed_Item_Id';
    protected $fillable = [
        'User_ID',
        'Item_Id'
    ];
}
