<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'level',
		'weekly_capacity',
		'created_at',
		'updated_at'
	];

	public function weekAllCapacity()
	{
		return self::sum('weekly_capacity')->get();
	}
}
