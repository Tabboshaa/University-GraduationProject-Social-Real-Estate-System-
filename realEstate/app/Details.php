<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    //
    protected $primaryKey='Detail_Id';
    protected $fillable = [
        'Item_Id',
        'Main_Type_Id',
        'Sub_Type_Id',
        'Property_Id',
        'Property_Detail_Id',
        'Property_diff',
        'DetailValue'
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
    public function detail()
    {
        return $this->belongsTo(Property_Details::class, 'Property_Detail_Id');
    }
    
}
