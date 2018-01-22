<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
