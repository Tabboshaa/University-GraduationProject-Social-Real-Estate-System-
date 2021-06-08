<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    //
    protected $primaryKey='Street_Id';
    protected $fillable=['Street_Name','Region_Id' , 'City_Id' , 'State_Id' , 'Country_Id','address_latitude',
        'address_longitude'];

    public function region(){
        return $this->belongsTo(Region::class, 'Region_Id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'City_Id');
    }
    public function state(){
        return $this->belongsTo(State::class, 'State_Id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'Country_Id');
    }
}
