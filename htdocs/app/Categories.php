<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = array('id', 'category', 'active','created_at','updated_at');
}
