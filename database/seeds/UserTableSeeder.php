<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
		DB::statement("SET foreign_key_checks = 0");
		DB::table('users')->delete();

		$users = [
			[
				'name' => 'Admin',
				'email' => 'admin@example.com',
				'password' => Hash::make('changeme'),
				'role' => 'ADMIN',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('users')->insert($users);
    }

}
