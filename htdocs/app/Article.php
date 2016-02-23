<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = array('id', 'title', 'content','creator','publish_date','active','created_at','updated_at');
}
