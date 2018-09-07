<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\comment;

class Comment extends Model
{
    protected $primaryKey = 'cid';
 	protected $table = 'comments';
 	
   public function user()
   {
      return $this->belongsTo(User::Class);
   }

   public function post()
   {
      return $this->belongsTo(Post::Class);
   }
}