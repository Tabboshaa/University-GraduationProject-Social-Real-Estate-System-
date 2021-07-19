<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation__Detail_Name extends Model
{
    //
    protected $table = 'operation__detail_name';
    protected $primaryKey='Detail_Id';
    protected $fillable = [
        'Operation_Id',
        'Operation_Type_Id',
        'Operation_Detail_Name'
    ];

    public function operationtype(){
        return $this->hasOne(Operation__types::class, 'Operation_Type_Id');
    }
    
}
