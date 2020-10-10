<?php

use App\MedicineType;
use Illuminate\Database\Seeder;

class MedicineTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedicineType::insert([
            ['name' => 'Antidepressants', 'created_at' => now()],
            ['name' => 'Statins', 'created_at' => now()],
            ['name' => 'GabapentInoid', 'created_at' => now()],
        ]);
    }
}
