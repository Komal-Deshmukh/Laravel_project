<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
	protected $table='useraddress';
	
    //The attributes that should be visible for arrays.
	protected $visible = ['address1', 'address2','user_id', 'city', 'state', 'zip', 'state', 'country'];
	protected $fillable = ['address1', 'address2','user_id', 'city', 'state', 'zip', 'state', 'country'];
	
	protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
	
	public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
	
}
