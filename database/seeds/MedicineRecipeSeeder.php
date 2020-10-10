<?php

use App\Medicine;
use App\MedicineReceipt;
use App\Receipt;
use Illuminate\Database\Seeder;

class MedicineRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Receipt::all() as $receipt) {
            $randomMedicines = rand(1, 10);
            for ($i = 0; $i < $randomMedicines; $i++) {
                MedicineReceipt::insert([
                    [
                        'quantity' => rand(10, 30),
                        'value' => rand(1, 50),
                        'receipt_id' => $receipt->id,
                        'medicine_id' => rand(1, Medicine::count()),
                        'created_at' => now(),
                    ]
                ]);
            }
        }
    }
}
