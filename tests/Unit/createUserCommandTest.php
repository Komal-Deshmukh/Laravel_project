<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class createUserCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserHandleSuccess()
    {
		//
		$this->artisan('create:test_users 2');
		$this->assertTrue(true);
    }
}
