<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'post_image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $directory = '/storage/';
    public function getPostImageAttribute($value){
        return  $this->directory.$value;
    }

}
