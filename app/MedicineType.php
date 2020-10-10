<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineType extends Model
{
    const ANTIDEPRESSANTS = 1;
    const STATINS = 2;
    const GABAPENTINOID = 3;

	protected $guarded = [];

	/* RELACIJE */
	public function medicines() {
		return $this->hasMany(Medicine::class);
	}

	/*  */
	public static function namesLowerCase() {
		$medicineTypes = self::all()->pluck('name');
		return $medicineTypes->transform(function($item, $key) {
			return strtolower($item);
		});
	}
}
