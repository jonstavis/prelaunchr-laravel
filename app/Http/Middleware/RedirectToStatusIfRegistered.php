<?php namespace App\Http\Middleware;

use Closure;
use Config;

class RedirectToStatusIfRegistered {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$referral_secret = session(Config::get('prelaunch.session:referral_secret'));

		if ($referral_secret) {
			return redirect()->route('user.status');
		}

		return $next($request);
	}

}
