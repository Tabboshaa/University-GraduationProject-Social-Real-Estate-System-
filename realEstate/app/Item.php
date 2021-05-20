<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $primaryKey='Item_Id';

    protected $fillable=[
        'Street_Id',
        'User_Id',
        'Item_Name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id');
    }

    public function street(){
        return $this->belongsTo(User::class, 'User_Id');
    }
}
