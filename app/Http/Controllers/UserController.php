<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Users;
use App\UserAddress;
use App\Events\TableAction;

class UserController extends Controller
{
    
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function showToken() {
      echo csrf_token(); 

    }
	
	public function saveUser(Request $request)
    {
		$v = Validator::make($request->all(), [
				'first_name' => 'required|alpha|max:50|min:3',       
				'last_name' => 'required|alpha|max:50|min:3',       
				'email' => 'required|email|unique:users|max:50|min:10', 
				'address1' => 'required|max:200|min:3', 
				'address2' => 'required|max:200|min:3', 
				'city' => 'required|max:50|min:3', 
				'state' => 'required|max:100|min:3', 
				'zip' => 'required|numeric|min:3', 
				'country' => 'required|max:50|min:3', 
			]);
        if ($v->fails()){
			return $v->messages()->get('*');
			
		 }else{
			$users = new Users;
			$users->first_name = $request->first_name;
			$users->last_name = $request->last_name;
			$users->email = $request->email;
			$users->save();
			//$users->id;
			
			$useraddress = new UserAddress;
			
			$useraddress->address1 = $request->address1;
			$useraddress->address2 = $request->address2;
			$useraddress->city = $request->city;
			$useraddress->state = $request->state;
			$useraddress->zip = $request->zip;
			$useraddress->country = $request->country;
			$users->address()->save($useraddress);
			
			$data['table_name']='users';
			$data['action']='create';
			TableAction::dispatch(json_encode($data));
		 }
	}

	 public function storeUserAddress(Request $request, $id)
    {
		$v = Validator::make($request->all(), [
			'address1' => 'required|max:200|min:3', 
			'address2' => 'required|max:200|min:3', 
			'city' => 'required|max:50|min:3', 
			'state' => 'required|max:100|min:3', 
			'zip' => 'required|numeric|min:3', 
			'country' => 'required|max:50|min:3', 
			]);
        //
		 if ($v->fails()){
			 return $v->messages()->get('*');
		 }else{
			
			$useraddress = new UserAddress;
			
			$useraddress->user_id = $id;
			$useraddress->address1 = $request->address1;
			$useraddress->address2 = $request->address2;
			$useraddress->city = $request->city;
			$useraddress->state = $request->state;
			$useraddress->zip = $request->zip;
			$useraddress->country = $request->country;
			$useraddress->save();
			
			$data['table_name']='users_address';
			$data['action']='create';
			//json_encode($data);
			TableAction::dispatch(json_encode($data));
		 }
	}
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = $users::where('id', $id)->first();
		$user = Users::where('id', $id)->with('address')->first();
		
		$userData['full_name']=$user->full_name;
		$userData['address1']=$user->address->address1;
		$userData['address2']=$user->address->address2;
		return $userData;
    }

	 public function showUserAddress($id)
    {
        $useraddress = new UserAddress;
		$address = $useraddress::where('user_id', $id)->first();
		dd($address);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$users = new Users;
		$data=array(
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'email' => $request->email,
				);
		$user = $users::where('id', $id)
				 ->update($data);
				 
		$useraddress = new UserAddress;		 
		$addressData=array(
				'address1' => $request->address1,
				'address2' => $request->address2,
				'city' => $request->city,
				'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
				);
				
		$useraddress::where('user_id', $id)
				 ->update($addressData);
		$data['table_name']='users';
		$data['action']='update';
			//json_encode($data);
		TableAction::dispatch(json_encode($data));				
    }

	//Delete model
	public function userDelete($id)
    {
		$users = new Users;
		$user = $users::where('id', $id);
		$user->delete();
	}
	
	public function userAddressDelete($id)
    {
        $useraddress = new UserAddress;
		$useraddress::where('id', $id)->delete();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
