<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            ['manager' => 'Marko Marković', 'created_at' => now()],
            ['manager' => 'Janko Janković', 'created_at' => now()],
        ]);
    }
}
