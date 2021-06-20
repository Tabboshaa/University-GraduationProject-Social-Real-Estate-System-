<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followedusers extends Model
{
    //
    protected $fillable = [
        'user_id',
        'following_user'
    ];
}
