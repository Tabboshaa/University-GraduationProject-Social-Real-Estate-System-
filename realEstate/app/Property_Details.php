<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_Details extends Model
{
    //
    
    protected $primaryKey='Property_Detail_Id';

    protected $fillable = [
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Id',
        'DataType_Id',
        'Detail_Name'
    ];
    public function maintype()
    {
        return $this->belongsTo(Main_Type::class, 'Main_Type_Id');
    }
    public function subtype()
    {
        return $this->belongsTo(Sub_Type::class, 'Sub_Type_Id');
    }
    public function property()
    {
        return $this->belongsTo(Sub_Type_Property::class, 'Property_Id');
    }
    public function datatype()
    {
        return $this->belongsTo(Datatype::class, 'DataType_Id');
    }
    

}
