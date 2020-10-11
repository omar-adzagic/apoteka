<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
	protected $guarded = [];

    /*  */
    public static function sledeciId() {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        return $statement[0]->Auto_increment;
    }

    /**
     * Relations
     */
	public function medicines() {
		return $this->belongsToMany(Medicine::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
	}
}
