<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    protected $fillable = array('id', 'project_id', 'user_id_comment','title_comment','content_comment','active','created_at','updated_at');
}
