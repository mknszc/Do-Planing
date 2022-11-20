<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
	public function getAllDesc()
	{
		return Task::select('*', DB::raw('(duration * level) as time'))
			->whereNull('week')
			->orderByRaw('(level * duration) DESC')
			->get();
	}

	public function getAllwithDeveloper()
	{
		return Task::with('developer')
			->select(
				DB::raw('GROUP_CONCAT(task_id) as tasks, week, developer_id, SUM(level * duration) as time'))
			->groupBy('week')
			->groupBy('developer_id')
			->orderBy('week')
			->whereNotNull('week')
			->whereNotNull('developer_id')
			->get();
	}

	public function getTotalTime()
	{
		$task =  Task::select(DB::raw('sum(duration * level) as total_time'))
			->first();

		return $task->total_time;
	}

	public function updateTask(array $array)
	{
		try {
			foreach ($array as $val) {
				$task = Task::find( $val['id']);
				$task->developer_id = $val['developer_id'];
				$task->week = $val['week'];
				$task->save();
			}
			return response('Success', 200);
		} catch (Exception) {
			return response('something went wrong', 400);
		}
	}
}