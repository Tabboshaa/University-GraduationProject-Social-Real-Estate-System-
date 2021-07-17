<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $primaryKey='Region_Id';
    protected $fillable=['Region_Name' , 'City_Id' , 'State_Id' , 'Country_Id'];
 
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
