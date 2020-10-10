<?php

// use DB;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() {
		Role::insert([
			['name' => 'Seller', 'created_at' => now()],
			['name' => 'Manager', 'created_at' => now()],
		]);
	}
}
