<?php

use App\Medicine;
use App\MedicineType;
use Illuminate\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicine::insert([
            ['name' => 'Remeron', 'quantity' => 15, 'price' => 12.25, 'medicine_type_id' => MedicineType::ANTIDEPRESSANTS, 'created_at' => now()],
            ['name' => 'Lexapro', 'quantity' => 23, 'price' => 10.05, 'medicine_type_id' => MedicineType::ANTIDEPRESSANTS, 'created_at' => now()],
            ['name' => 'Crestor', 'quantity' => 31, 'price' => 9.5, 'medicine_type_id' => MedicineType::STATINS, 'created_at' => now()],
            ['name' => 'Zocor', 'quantity' => 26, 'price' => 8.95, 'medicine_type_id' => MedicineType::STATINS, 'created_at' => now()],
            ['name' => 'Lyrica ', 'quantity' => 22, 'price' => 3.35, 'medicine_type_id' => MedicineType::GABAPENTINOID, 'created_at' => now()],
        ]);
    }
}
