<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $fillable = array('id', 'amount', 'time','reward_status','donation_status',
        'bank_account', 'user_id','project_id','active','created_at','updated_at');
}
