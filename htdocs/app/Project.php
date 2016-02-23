<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = array('id', 'name', 'summary','detail','category','amount_funding',
        'funding_duration','reward','time','status','image','video','home','update','user_id','featured','active','created_at','updated_at');
}
