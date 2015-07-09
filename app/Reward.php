<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model {

	public function scopeOrdered($query)
	{
		return $query->orderBy('num_referrals');
	}

}
