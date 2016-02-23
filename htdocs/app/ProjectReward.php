<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectReward extends Model
{
    protected $fillable = array('id', 'project_id', 'reward_1','reward_2','reward_3','reward_4',
        'reward_5','count_1','count_2','count_3','count_4','count_5','active','created_at','updated_at');
}
