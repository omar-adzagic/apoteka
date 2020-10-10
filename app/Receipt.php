<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receipt extends Model
{
	protected $guarded = [];

	/* RELACIJE */
	public function medicine() {
		return $this->belongsTo(Medicine::class);
	}

	public function medicines() {
		return $this->belongsToMany(Medicine::class)->withPivot(['quantity', 'value'])->withTimeStamps();
	}

	/*  */
	public static function sledeciId() {
		$statement = DB::select("SHOW TABLE STATUS LIKE 'receipts'");
		return $statement[0]->Auto_increment;
	}
}
