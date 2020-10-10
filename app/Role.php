<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SELLER = 1;
    const MANAGER = 2;
	protected $guarded = [];

	public function users() {
		return $this->hasMany(User::class);
	}

    public function hasUser($user) {
        return $this->users->contains($user);
    }
}
