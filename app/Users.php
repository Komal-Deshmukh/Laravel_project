<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class Users extends Model
{
	use SoftDeletes;
	
    //The attributes that should be visible for arrays.
	protected $visible = ['first_name', 'last_name',];
	
	protected $appends = ['full_name'];
	
	protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
	
	private $rules = array(
        'first_name' => 'required|alpha|max:50|min:3',       
        'last_name' => 'required|alpha|max:50|min:3',       
        'email' => 'required|email|unique:users',       
    );
	
	
	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}
	
	public function address()
    {
        return $this->hasOne(UserAddress::class,'user_id');
    }
	
	public function validateEmail($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()){
			
            // set errors and return false
            //$this->errors = $v->errors;
            return $v->messages()->get('*');
        }else{
			// validation pass
			return true;
		}       
    }
}

