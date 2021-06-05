<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    //
    protected $primaryKey = 'Item_Id';

    protected $fillable = [
        'Street_Id',
        'User_Id',
        'Item_Name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'Street_Id');
    }

    public function coverpage()
    {
        return $this->hasOne(Cover_Page::class, 'Item_Id');
    }
    public function operations()
    {
        return $this->hasMany(operations::class, 'Item_Id');
    }
    public function posts()
    {
        return $this->hasMany(posts::class, 'Item_Id');
    }
    public function followers()
    {
        return $this->hasMany(followeditemsbyuser::class, 'Item_Id');
    }
//function is user in Customer Profile Blade to determine if user followes this item 
    public function checkfollow()
    {
        return $this->hasMany(followeditemsbyuser::class, 'Item_Id')->where('User_Id','=',Auth::id());

    }
}
