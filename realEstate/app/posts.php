<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    //
    protected $primaryKey='Post_Id';
    protected $fillable = [
        'Item_Id',
        'User_Id',
        'Post_Title',
        'Post_Content'
    ];

    //shaimaa
    public function item(){
        return $this->belongsTo(Item::class, 'Item_Id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'User_Id');
    }

    public function postAttachment(){
        return $this->hasMany(post_attachment::class, 'Post_Id');
    }

    public function comments(){
        return $this->hasMany(comments::class, 'Post_Id')->where('Parent_Comment','=',null);
    }
   



}
