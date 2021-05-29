<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cover_Page extends Model
{
    //
    protected $primaryKey='id';
    protected $fillable = [
        'Item_Id',
        'path'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'Item_Id');
    }
}
