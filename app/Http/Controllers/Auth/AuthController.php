<?php namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Redirect;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar, User $user)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->user = $user;

		$this->middleware('guest', ['except' => [ 'getLogout', 'getConfirm', 'getResendConfirm' ]]);
	}

	/**
	 * Get register override - does nothing since register is not public
	 *
	 */
	public function getRegister()
	{
		return Redirect::route('user.create');
	}

	/**
	 * Post register override - does nothing since register is not public
	 *
	 */
	public function postRegister()
	{
	}

	/**
	 * Confirm a user email address
	 *
	 * @param mixed $confirmation_code
	 */
	public function getConfirm($confirmation_code)
	{
		$user = $this->user->whereConfirmationCode($confirmation_code)->first();	
		
		if ($user)
		{
			$user->valid_email = true;
			$user->save();

			flash()->success("Thanks for registering!  You may now begin sharing your referral link to receive rewards.");

			return Redirect::route('user.status', [ $user->referral_secret ]);
		}

		flash()->error("Invalid confirmation code");

		return Redirect::route('user.create');
	}

	public function getResendConfirm($confirmation_code)
	{
		$user = $this->user->whereConfirmationCode($confirmation_code)->first();	

		$referral_secret = '';
		if ($user)
		{
			$referral_secret = $user->referral_secret;

			$user->sendConfirmation();

			flash()->success('Confirmation sent.  Please check your email.');
		}

		return Redirect::route('user.status', $referral_secret);
	}
}
