<?php

namespace App\Listeners;

use App\Events\TableAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserActivity;

class SendActionTriggerNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
	
		
	
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TableAction  $event
     * @return void
     */
    public function handle(TableAction $event)
    {
 
		$useractions=json_decode($event->userAction);
		$activities=new UserActivity;
		$activities->table_name = $useractions->table_name;
		$activities->action = $useractions->action;
		$activities->save();
		// $saveHistory = DB::table('activities')->insert(
            // ['table_name' => 'Users', 'action' => 'Created', 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
        // );
    }
}
