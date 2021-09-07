<?php

namespace App\Console\Commands;

use App\Model;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Users;
use App\UserAddress;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:test_users  {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->argument('count');
		
		if($count > 300){
			return false;
		}else{
			//$request = new \Illuminate\Http\Request();
			for($i=0; $i<$count; $i++){
				$userFakerData=factory(Users::class)->make();
				$userAddressFakerData=factory(UserAddress::class)->make();
				
				$request = Request::create('/userSave', 'POST',[
					'first_name' => $userFakerData->first_name,
					'last_name' => $userFakerData->last_name,
					'email' => $userFakerData->email,
					'address1' => $userAddressFakerData->address1,
					'address2' => $userAddressFakerData->address2,
					'city' => $userAddressFakerData->city,
					'state' => $userAddressFakerData->state,
					'zip' => $userAddressFakerData->zip,
					'country' => $userAddressFakerData->country
				]);
				$userctl= new UserController;
				$userctl->saveUser($request);
			}
			return true;
			
		}
    }
}
