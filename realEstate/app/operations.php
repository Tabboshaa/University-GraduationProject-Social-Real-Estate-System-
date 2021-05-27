<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operations extends Model
{
    //
    protected $primaryKey='Operation_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_Id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'Item_Id');
    }
    public function operationtype(){
        return $this->hasOne(Operation__types::class, 'Operation_Id');
    }
    public function operationdetails(){
        return $this->hasMany(Operation__Detail_Value::class, 'Operation_Id');
    }


}
