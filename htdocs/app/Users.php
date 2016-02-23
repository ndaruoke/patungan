<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = array('id', 'title', 'content','creator','publish_date','active','created_at','updated_at');
}
