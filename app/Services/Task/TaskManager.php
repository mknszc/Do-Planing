<?php

namespace App\Services\Task;

use Illuminate\Support\Facades\Config;

class TaskManager
{
	public array $allData = [];

	public function getTasks(): array
	{
		$array = Config::get('providers');
		$i = 0;
		foreach ($array as $item) {
			$tasks = (new TaskService($item['url']))->getData();
			foreach ($tasks as $task) {
				if ($item['depth'] == 1) {
					$this->allData[$i]['task_id'] = $task[$item['task_id']];
					$this->allData[$i]['level'] = $task[$item['level']];
					$this->allData[$i]['duration'] = $task[$item['duration']];

					$i++;
				} else if ($item['depth'] == 2) {
					foreach ($task as $key => $value) {
						$this->allData[$i]['task_id'] = $key;
						$this->allData[$i]['level'] = $value[$item['level']];
						$this->allData[$i]['duration'] = $value[$item['duration']];

						$i++;
					}
				}
			}
		}

		return $this->allData;
	}
}