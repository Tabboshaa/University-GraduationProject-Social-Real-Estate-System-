<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation__Detail_Value extends Model
{
    //
    protected $table = 'operation___detail__values';
    protected $primaryKey='Value_Id';
    protected $fillable = [
        'Operation_Id',
        'Operation_Type_Id',
        'Detail_Id',
        'Operation_Detail_Value'
    ];

    public function detailname()
    {
        return $this->belongsTo(Operation__Detail_Name::class, 'Detail_Id');
    }
    public function operations(){
        return $this->hasMany(operations::class, 'Item_Id');
    }

}
