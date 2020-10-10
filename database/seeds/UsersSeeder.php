<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('users')->delete();

		User::insert([
		    ['name' => 'test ime', 'surname' => 'test prezime', 'email' => 'test@email.com', 'role_id' => Role::SELLER, 'password' => Hash::make('12345678')],
		    ['name' => 'Manager ime', 'surname' => 'Manager prezime', 'email' => 'manager@email.com', 'role_id' => Role::MANAGER, 'password' => Hash::make('12345678')],
        ]);
	}
}
