<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $primaryKey='id';
    protected $fillable = [
        'Image',
        'First_Name',
        'Middle_Name',
        'Last_Name',
        'Birth_Day',
        'Gender',
        'password',
        'National_ID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function items(){
        return $this->hasMany(Item::class, 'User_Id');
    }
}
