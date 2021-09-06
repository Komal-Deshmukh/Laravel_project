<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    //The attributes that should be visible for arrays.
	protected $table='activities';
	
	protected $visible = ['table_name', 'action'];
	
	protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
}
