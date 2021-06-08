<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    protected $primaryKey='Comment_Id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'Post_Id',
        'User_Id',
        'Attachment_Id',
        'Parent_Comment',
        'Comment'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'User_Id');
    }
    public function post(){
        return $this->hasOne(posts::class, 'Post_Id');
    }
    public function attachment(){
        return $this->hasOne(attachment::class, 'Attachment_Id');
    }
    public function parentcomment(){
        return $this->belongsTo(comments::class, 'Comment_Id');
    }

    public function replies(){
        return $this->hasMany(comments::class, 'Parent_Comment');
    }
}
