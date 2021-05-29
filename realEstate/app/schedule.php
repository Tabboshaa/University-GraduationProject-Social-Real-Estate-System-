<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $primaryKey='schedule_Id';
    protected $fillable = [
        'Item_Id',
        'Start_Date',
        'End_Date',
        'Price_Per_Night'
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'Item_Id');
    }

    public function coverpage(){
        return $this->hasOne(Cover_Page::class, 'Item_Id');
    }
    public function operations(){
        return $this->hasMany(operations::class, 'Item_Id');
    }
}
