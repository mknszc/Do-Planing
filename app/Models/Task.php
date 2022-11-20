<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string, \Illuminate\Database\Query\Expression $raw)
 */
class Task extends Model
{
    use HasFactory;

	protected $fillable = [
		'task_id',
		'duration',
		'level',
		'developer_id',
		'week',
		'created_at',
		'updated_at'
	];

	public function developer()
	{
		return $this->belongsTo(Developer::class, 'developer_id');
	}
}
