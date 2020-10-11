<?php

use App\Medicine;
use App\MedicineOrder;
use App\Order;
use Illuminate\Database\Seeder;

class MedicineOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Order::all() as $order) {
            $randNumberOfMedicine = rand(5, 10);
            for ($i = 0; $i < $randNumberOfMedicine; $i++) {
                MedicineOrder::insert([
                    ['quantity' => rand(10, 50), 'order_id' => $order->id, 'medicine_id' => rand(1, Medicine::count()), 'created_at' => now()],
                ]);
            }
        }
    }
}
