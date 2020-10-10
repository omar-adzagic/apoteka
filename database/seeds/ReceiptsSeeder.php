<?php

use App\Receipt;
use Illuminate\Database\Seeder;

class ReceiptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Receipt::insert([
            ['total_price' => rand(10, 50), 'seller' => 'Test seller', 'created_at' => now()],
            ['total_price' => rand(10, 50), 'seller' => 'New seller', 'created_at' => now()],
        ]);
    }
}
