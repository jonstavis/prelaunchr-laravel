<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Mail;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * Pseudo-attributes to append for admin
	 *
	 * @var string
	 */
	protected $appends = [ 'referral_url', 'referral_status_url' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function referrer()
	{
		return $this->belongsTo('App\User', 'referrer_id');
	}

	public function referrals()
	{
		return $this->hasMany('App\User', 'referrer_id');
	}

	public function confirmedReferrals()
	{
		return $this->hasMany('App\User', 'referrer_id')->whereValidEmail(true);
	}

	public function getReferralUrlAttribute()
	{
		return route('user.referral', [ $this->referral_code ]);
	}

	public function getReferralStatusUrlAttribute()
	{
		return route('user.status', [ $this->referral_secret ]);
	}

	public function setPasswordAttribute($value)
	{
		if ($value) 
		{
			$this->attributes['password'] = bcrypt($value);
		}
	}

	public function isAdmin()
	{
		return $this->role == 'ADMIN';
	}

	public function sendConfirmation()
	{
		$email = $this->email;
		$name = $this->name;
		Mail::queue('emails.confirm', [ 'token' => $this->confirmation_code, 'secret' => $this->referral_secret ], function($message) use ($email, $name) 
		{
			$message->to($email, $name)->subject('Welcome to MidwestFit!');
		});	
	}

}
