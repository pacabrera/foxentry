<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{


    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::Class);
    }

    public function likes()
    {
        return $this->hasMany(Like::Class);
    }
}
