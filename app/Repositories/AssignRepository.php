<?php

namespace App\Repositories;

/**
 * @property TaskRepository $taskRepository
 * @property DeveloperRepository $developerRepository
 */
class AssignRepository
{
	public function __construct(TaskRepository $taskRepository, DeveloperRepository $developerRepository)
	{
		$this->taskRepository = $taskRepository;
		$this->developerRepository = $developerRepository;
	}

	public function assignTaskAndSave(): bool
	{
		$plan = [];
		$planTemp = [];
		$tasks = $this->taskRepository->getAllDesc();
		$developers = $this->developerRepository->getAll();
		$totalTaskTime = $this->taskRepository->getTotalTime();
		$totalDevCapacity = $this->developerRepository->getTotalCapacity();

		for ($week = 1; !empty($tasks); $week++) {
			if ((int)($totalTaskTime / $totalDevCapacity) > 0) {
				foreach ($developers as $dev) {
					$total = 0;
					foreach ($tasks as $key => $task) {
						if ($total + ($task->time) <= ($dev->capacity)) {
							$total += $task->time;
							$plan[$task->id]['id'] = $task->id;
							$plan[$task->id]['developer_id'] = $dev->id;
							$plan[$task->id]['week'] = $week;
							$totalTaskTime -= $task->time;
							unset($tasks[$key]);
						}
					}
				}
			} else {
				$ratio = ($totalDevCapacity / $totalTaskTime);
				$tasksTemp = $tasks->toArray();

				while (!empty($tasksTemp)) {
					foreach ($developers as $dev) {
						$capacity = ($dev->capacity / $ratio);
						$total = 0;
						foreach ($tasksTemp as $key => $taskTemp) {
							if ($total + ($taskTemp['time']) <= ($capacity)) {
								$total += $taskTemp['time'];
								$planTemp[$taskTemp['id']]['id'] = $taskTemp['id'];
								$planTemp[$taskTemp['id']]['developer_id'] = $dev->id;
								$planTemp[$taskTemp['id']]['week'] = $week;
								unset($tasksTemp[$key]);
							}
						}
					}

					if (!empty($tasksTemp)) {
						$tasksTemp = $tasks->toArray();
						$ratio -= 0.05;
					} else {
						$tasks = [];
					}
				}
			}
		}

		$plan = array_merge($plan, $planTemp);

		$this->taskRepository->updateTask($plan);

		return true;
	}
}
