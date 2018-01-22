<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'post_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
