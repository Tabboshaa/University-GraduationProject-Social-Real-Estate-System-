<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey='id';
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

    //shaimaa
    public function items(){
        return $this->hasMany(Item::class, 'User_Id');
    }

    public function emails(){
        return $this->hasMany(Emails::class, 'User_Id');
    }

    public function phoneNumbers(){
        return $this->hasMany(Phone_Numbers::class, 'User_Id');
    }

    public function profilePhoto(){
        return $this->hasMany(ProfilePhoto::class, 'User_Id');
    }

    public function coverPhoto(){
        return $this->hasMany(CoverPhoto::class, 'User_Id');
    }

    public function operations(){
        return $this->hasMany(operations::class, 'User_Id');
    }

}
