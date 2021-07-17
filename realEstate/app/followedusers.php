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
    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }
    public function followinguser(){
        return $this->hasOne(User::class, 'following_user');
    }
}
