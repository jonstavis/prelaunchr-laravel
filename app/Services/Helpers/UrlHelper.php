<?php

if ( ! function_exists('homepage_url'))
{
	function homepage_url() 
	{
		$referrer_code = session(Config::get('prelaunch.session:referrer'));

		if ($referrer_code)
		{
			return route('user.referral', $referrer_code);
		}

		return route('user.create');
	}
}

if ( ! function_exists('elixir_cachebust'))
{
	/**
	* Get the path to a versioned Elixir Cachebust file.
	*
	* @param  string  $file
	* @return string
	*/
	function elixir_cachebust($file)
	{
		static $manifest = null;

		if (is_null($manifest))
		{
			$manifest = json_decode(file_get_contents(public_path().'/hashmap.json'), true);
		}

		if (isset($manifest[$file]))
		{
			return asset($file) . '?' . $manifest[$file];
		}

		throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
	}
}
