<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(RolesSeeder::class);
		$this->call(UsersSeeder::class);
		$this->call(MedicineTypesSeeder::class);
		$this->call(MedicinesSeeder::class);
		$this->call(ReceiptsSeeder::class);
		$this->call(MedicineRecipeSeeder::class);
		$this->call(OrdersSeeder::class);
		$this->call(MedicineOrderSeeder::class);
	}
}
