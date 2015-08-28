## Prelaunchr-Laravel

Inspired by the [harrystech/prelaunchr](https://github.com/harrystech/prelaunchr) Ruby on Rails app and a [blog post by Tim Ferriss](http://fourhourworkweek.com/2014/07/21/harrys-prelaunchr-email), Prelaunchr-Laravel provides similar functionality for those working with a PHP/Laravel technology stack.  

The app provides an email signup, referral links, private referral status page, and prize levels for various numbers of referrals.  The app was written for the launch of [midwestfit.com](https://midwestfit.com) to gather referrals and offer free membership extensions to users.  By default, the HTML/CSS for MidwestFit is included in this repository.  A demo version of the app can be found [here](http://prelaunch.midwestfit.com/) with emails disabled.

## Mechanics

Prelaunchr-Laravel has a main mechanic from which everything else is derived: Every User is given a unique referral_code which is how the application knows who referred a signing up user. Based on the amount of referrals a User has brought to the site, they are put into a different "prize group". The groups, amounts, and prizes are completely up to you to set.  

Users additionally have a referral_secret.  This allows for a permanent, private referral status page for each user to see prizes earned.  Otherwise, users automatically see this private page as long as their session remains alive in the browser which originated the email signup.  As a testing feature you may leave the status page and return to the homepage by visiting `/homepage`

Rewards are given based on confirmed emails.  An email is confirmed by clicking on a link sent to each new email address entered on the main site page.

## IP Blocking

Multiple signups from the same IP address may be blocked.  This number is configurable via the `IP_LIMIT` .env.php property.

## Setup

* `composer install`
* Copy .env.example to .env and set your database connection properties.
* `php artisan migrate`
* `php artisan db:seed`
* `npm install`
* `gulp watch`
* `php artisan serve`


## Admin

A simple [Laravel Administrator](https://github.com/FrozenNode/Laravel-Administrator) administrator panel is available at `/admin`.  You may customize this by following their [documentation](http://administrator.frozennode.com/).  

An admin user is provided in this project's seed file.

## Teardown

There is currently no automated teardown method to collect referrals.  This may be done easily by connecting your live launched app to the prelaunch-laravel database and creating a new model with a few Eloquent relationships:

```php
<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PrelaunchUser extends Model {

	protected $connection = 'prelaunch';
	protected $table = 'users';

	public function referrer()
	{
		return $this->belongsTo('App\PrelaunchUser', 'referrer_id');
	}

	public function referrals()
	{
		return $this->hasMany('App\PrelaunchUser', 'referrer_id');
	}

	public function confirmedReferrals()
	{
		return $this->hasMany('App\PrelaunchUser', 'referrer_id')->whereValidEmail(true);
	}
}
````

Count referrals with:

```php
	PrelaunchUser::referrals()->count();
````

## License

The code, documentation, non-branded copy and configuration are released under the MIT license. Any branded assets are included only to illustrate and inspire.

Please change the artwork to use your own brand! MidwestFit does not give you permission to use its logos, brand, or trademarks in your own marketing.  Stock images are protected by copyright and may not be used in any manner.

## Attributions

* [Deadlift by Scott Lewis from the Noun Project](https://thenounproject.com/term/deadlift/882/)
* [Weight Lifting by Scott Lewis from the Noun Project](https://thenounproject.com/term/weight-lifting/883/)
* [Person by Connor Shea from the Noun Project](https://thenounproject.com/search/?q=person&i=63361)
* [Person by Bob Smith from the Noun Project](https://thenounproject.com/search/?q=person&i=63858)
* [Weight Lifting by Ben King from the Noun Project](https://thenounproject.com/search/?q=weight-lifting&i=38420)
