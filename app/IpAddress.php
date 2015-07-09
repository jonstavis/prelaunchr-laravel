<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['address'];

	/**
	 * Increment the count, save this instance, and make sure count is below a limit
	 *
	 */
	public function incrementSaveAndCheck()
	{
		$this->count ++;
		$this->save();

		$limit = env('IP_LIMIT', 2);

		// allow up to 2 emails from one ip
		return $this->count <= $limit;
	}

}
