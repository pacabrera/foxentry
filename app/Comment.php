<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\comment;

class Comment extends Model
{
    protected $primaryKey = 'cid';
 	protected $table = 'comments';

    public function status(){
        return $this->belongsTo('Status::class', 'statusId');
    }

}