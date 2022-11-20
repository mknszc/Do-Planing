<?php

namespace App\Services\Task;

use Illuminate\Support\Facades\Config;

class TaskManager
{
	public function getTasks(): array
	{
		$allData = [];
		$array = Config::get('providers');
		$i = 0;
		foreach ($array as $item) {
			$tasks = (new TaskService($item['url']))->getData();
			foreach ($tasks as $task) {
				if ($item['depth'] == 1) {
					$allData[$i]['task_id'] = $task[$item['task_id']];
					$allData[$i]['level'] = $task[$item['level']];
					$allData[$i]['duration'] = $task[$item['duration']];

					$i++;
				} elseif ($item['depth'] == 2) {
					foreach ($task as $key => $value) {
						$allData[$i]['task_id'] = $key;
						$allData[$i]['level'] = $value[$item['level']];
						$allData[$i]['duration'] = $value[$item['duration']];

						$i++;
					}
				}
			}
		}

		return $allData;
	}
}
