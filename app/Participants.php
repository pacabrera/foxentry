<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $primaryKey = 'participantID';
    protected $table = 'participants';
}