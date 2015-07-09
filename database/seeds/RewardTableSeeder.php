<?php

use App\Reward;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RewardTableSeeder extends Seeder {

    public function run()
    {
		DB::statement("SET foreign_key_checks = 0");
		DB::table('rewards')->delete();

		$rewards = [
			[
				'num_referrals' => 0,
				'title' => 'Two Weeks Free',
				'description' => 'Sign up to receive two weeks for free',	
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'num_referrals' => 1,
				'title' => 'Additional Two Weeks Free',
				'description' => 'Refer 1 friends for an additional two weeks for free',	
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'num_referrals' => 3,
				'title' => 'Additional Month Free',
				'description' => 'Refer 3 or more friends for an additional month for free',	
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];	

		DB::table('rewards')->insert($rewards);
    }

}
