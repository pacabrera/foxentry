<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actuallymab\LaravelComment\Commentable;
class Status extends Model
{
	use Commentable;

   protected $primaryKey = 'statusId';
   protected $table = 'statuses';


	public function comments(){
      return $this->hasMany(comments::class,'statusId');
    }
}