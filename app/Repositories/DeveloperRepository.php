<?php

namespace App\Repositories;

use App\Models\Developer;
use Illuminate\Support\Facades\DB;

class DeveloperRepository
{
	public function getAll()
	{
		return Developer::select('*', DB::raw('(weekly_capacity * level) as capacity'))
			->orderByDesc('level')
			->get();
	}

	public function getTotalCapacity()
	{
		$developer = Developer::select(DB::raw('sum(weekly_capacity * level) as total'))
			->first();

		return $developer->total;
	}
}
