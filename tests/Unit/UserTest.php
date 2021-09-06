<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
    
	/** 
    public function testExample()
    {
        $this->assertTrue(true);
    }
	 */
	public function test_store_method_insert_user()
	{
		$request = Request::create('/userSave', 'POST',[
			'first_name' => 'komal',
			'last_name' => 'Desh',
			'email' => 'komald16@cybage.com',
			'address1' => 'Pimple Gurav',
			'address2' => 'Sangavi',
			'city' => 'Pune',
			'state' => 'Maharashtra',
			'zip' => '411061',
			'country' => 'India'
		]);
		
		$usercontrol= new UserController();
		
		$response = $usercontrol->saveUser($request);
		$this->assertSame(200, $response);
		
	} 
	/*
	public function test_store_method_insert_userAddress()
	{
		$request = Request::create('/user/1/user_address', 'POST',[
			'address1' => 'Sangavi',
			'address2' => 'Sangavi',
			'city' => 'Pune',
			'state' => 'Maharashtra',
			'zip' => '61',
			'country' => 'India'
		]);
		
		$usercontrol= new UserController();
		
		$response = $usercontrol->storeUserAddress($request,1);
		$this->assertSame(200, $response);
		
	} 
	
	public function test_show_method_user()
	{
		$response = $this->call('GET','/user/20');
		$this->assertEquals(200,$response->getStatusCode());
		
	} 
	
	public function test_show_method_userAddress()
	{
		$response = $this->call('GET','/user/20/user_address'); 
		$this->assertTrue($response);
		
	} 
	
	public function test_update_method_user()
	{
		$request = Request::create('/user/20', 'PUT',[
			'first_name' => 'komal',
			'last_name' => 'Desh',
			'email' => 'komal31@cybage.com',
			'address1' => 'Pimple',
			'address2' => 'Sangavi',
			'city' => 'Pune',
			'state' => 'Maharashtra',
			'zip' => '411061',
			'country' => 'India'
		]); 
		$usercontrol= new UserController();
		
		$response = $usercontrol->update($request,20);
		$this->assertNull($response);
		
	}
	
	public function test_delete_method_user()
	{
		$response = $this->call('DELETE','/user/21'); 
		$this->assertEquals(200,$response->getStatusCode());
	} 
	
	public function test_delete_method_userAddress()
	{
		$response = $this->call('DELETE','/user_address/1'); 
		$this->assertEquals(200,$response->getStatusCode());
	} 
	
	public function testEmailAddress()
	{
		$users= new \App\Users;
		$data=array(
			'first_name' => 'komal',
			'last_name' => 'Desh',
			'email' => 'komal7@cybage.com'
		);
		$this->assertSame($users->validateEmail($data),true);
		
	}  
	*/
}
