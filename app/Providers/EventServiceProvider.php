<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App;
use App\User;
use Config;
use Event;
use Log;
use Request;
use Mail;
use Session;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		User::creating(function($user)
		{
			$user->ip_address = Request::ip();

			$user->confirmation_code = str_random(60);
			$user->referral_code = str_random(10);
			$user->referral_secret = str_random(10);

			Session::put(Config::get('prelaunch.session:referral_secret'), $user->referral_secret);
		});

		User::created(function($user)
		{
			$user->sendConfirmation();
		});

		# query logger
		if(App::environment('local'))
		{
			Event::listen('illuminate.query', function($sql,$bindings,$time) {
				for ($i = 0; $i < sizeof($bindings); $i++) {
					if ($bindings[$i] instanceof DateTime) {
						$bindings[$i]= $bindings[$i]->getTimestamp();
					}
				}
				Log::info(sprintf("%s (%s) : %s",$sql,implode(",",$bindings),$time));
			});

		}
	}

}
