<?php namespace App\Http\Controllers;

use \Config;
use \Session;

use \App\IpAddress;
use \App\Reward;
use \App\User;
use \App\Http\Requests\CreateUserRequest;

class UsersController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(IpAddress $ip_address, Reward $reward, User $user)
	{
		$this->ip_address = $ip_address;
		$this->reward = $reward;
		$this->user = $user;
	}

	/**
	 * Show the application welcome screen and create user form
	 *
	 * @return Response
	 */
	public function create()
	{
		// forget the referral secret if user ends up back on the homepage
		Session::forget(Config::get('prelaunch.session:referral_secret'));

		return view('user.create');
	}

	/**
	 * Read a user's referral code and redirect to the normal welcome page
	 *
	 * @param mixed $referrer_code The referral code of the referring user
	 * @return Response
	 */
	public function referral($referrer_code)
	{
		Session::put(Config::get('prelaunch.session:referrer'), $referrer_code);

		return view('user.create');
	}

	/**
	 * Store a new user from the main referral page
	 *
	 */
	public function store(CreateUserRequest $request)
	{
		$ip_address = $this->ip_address->firstOrCreate([ 'address' => $request->ip() ]);	

		if (!$ip_address->incrementSaveAndCheck())
		{
			flash()->error('It appears that you have registered with too many emails.');
			return redirect()->route('user.create');
		}

		$input = $request->all();

		$user = $this->user->create($input);

		$referrer_code = Session::get(Config::get('prelaunch.session:referrer'));

		if ($referrer_code)
		{
			$referrer = User::whereReferralCode($referrer_code)->first();

			if ($referrer)
			{
				$user->referrer_code = $referrer_code;
				$user->referrer_id = $referrer->id;
				$user->save();
			}
		}

		flash()->success('Thanks for registering!  A confirmation link was sent to you.  You must confirm your email address in order to start receiving rewards for your referrals.  Check your spam folder if you don\'t immediately see the email.');

		return redirect()->route('user.status', [ $user->referral_secret ]);
	}

	/**
	 * Show the status page for a user
	 *
	 * @param mixed $referral_secret
	 */
	public function status($referral_secret = null)
	{
		if ($referral_secret) 
		{ 
			Session::put(Config::get('prelaunch.session:referral_secret'), $referral_secret);
		}

		if (!$referral_secret) { $referral_secret = session(Config::get('prelaunch.session:referral_secret')); }

		if (!$referral_secret) { abort(404); }

		$user = $this->user->with('confirmedReferrals')->whereReferralSecret($referral_secret)->firstOrFail();	

		$rewards = $this->reward->ordered()->get();

		$referrals = $user->confirmedReferrals;
		$referral_count = $user->valid_email ? $referrals->count() : 0;

		// this is a little sloppy.. should be cleaned up
		$highest_referral_number = $rewards->last()->num_referrals;
		$progress_percent = (100 / ($highest_referral_number + 2)) * ($referral_count + 1) + $referral_count;

		return view('user.status', compact('user', 'rewards', 'referrals', 'referral_count', 'progress_percent'));
	}
}
