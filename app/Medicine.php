<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
	protected $guarded = [];

    /**
     * Relations
     */
	public function medicineType() {
		return $this->belongsTo(MedicineType::class);
	}

	public function receipts() {
		return $this->belongsToMany(Receipt::class)->withPivot(['quantity', 'value'])->withTimeStamps();
	}

	public function orders() {
		return $this->belongsToMany(Order::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
	}

	/*  */
	public static function search($search) {
		return self::with('medicineType')
			->join('medicine_types', 'medicines.medicine_type_id', '=', 'medicine_types.id')
			->select('medicines.*', 'medicine_types.name as medicine_type')
			->where('medicines.name', 'LIKE', "%$search%")
			->orWhere('medicine_types.name', 'LIKE', "%$search%")
			->orderBy(session('medOrder'), session('medSort'))
			->paginate(6)
			->appends(request()->only('search'));
	}

	public static function sortMedicineType() {
		return self::with('medicineType')
			->join('medicine_types', 'medicines.medicine_type_id', '=', 'medicine_types.id')
			->select('medicines.*', 'medicine_types.name as medicine_type')
			->orderBy(session('medOrder'), session('medSort'))
			->paginate(6);
	}

	// public static function defaultniPrikaz() {
	// 	return self::orderBy(session('medOrder'), session('medSort'))->paginate(6);
	// }

	public static function medicinesNazivi() {
		$medicines = Medicine::all()->pluck('name');
		return $medicines->transform(function($item, $key) {
			return strtolower($item);
		});
	}

}
