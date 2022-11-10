<?php

namespace App\Http\Controllers;

use App\Repositories\DeveloperRepository;
use App\Repositories\TaskRepository;

/**
 * @property TaskRepository $taskRepository
 * @property DeveloperRepository $developerRepository
 */
class AssignController extends Controller
{
	public function __construct(
		TaskRepository $taskRepository,
		DeveloperRepository $developerRepository)
	{
		$this->taskRepository = $taskRepository;
		$this->developerRepository = $developerRepository;
	}

	public function index()
	{
		$tasks = $this->taskRepository->getAllwithDeveloper();

		return view('assign', compact('tasks'));
	}

	public function assignTask()
	{
		$plan = [];
		$plan_temp = [];
		$tasks = $this->taskRepository->getAllDesc();
		$developers = $this->developerRepository->getAll();
		$total_task_time = $this->taskRepository->getTotalTime();
		$total_dev_capacity = $this->developerRepository->getTotalCapacity();

		for ($week = 1; count($tasks) > 0; $week++) {
			if ((int)($total_task_time / $total_dev_capacity) > 0) {
				foreach ($developers as $dev) {
					$total = 0;
					foreach ($tasks as $key => $task) {
						if ($total + ($task->time) <= ($dev->capacity)) {
							$total += $task->time;
							$plan[$task->id]['id'] = $task->id;
							$plan[$task->id]['developer_id'] = $dev->id;
							$plan[$task->id]['week'] = $week;
							$total_task_time -= $task->time;
							unset($tasks[$key]);
						}
					}
				}
			} else {
				$ratio = ($total_dev_capacity / $total_task_time);
				$tasks_temp = $tasks->toArray();

				while (count($tasks_temp) > 0) {
					foreach ($developers as $dev) {
						$capacity = ($dev->capacity / $ratio);
						$total = 0;
						foreach ($tasks_temp as $key => $task_temp) {
							if ($total + ($task_temp['time']) <= ($capacity)) {
								$total += $task_temp['time'];
								$plan_temp[$task_temp['id']]['id'] = $task_temp['id'];
								$plan_temp[$task_temp['id']]['developer_id'] = $dev->id;
								$plan_temp[$task_temp['id']]['week'] = $week;
								unset($tasks_temp[$key]);
							}
						}
					}

					if (count($tasks_temp) > 0) {
						$tasks_temp = $tasks->toArray();
						$ratio -= 0.05;
					} else {
						$tasks = [];
					}
				}
			}
		}

		$plan =  array_merge($plan, $plan_temp);

		$this->taskRepository->updateTask($plan);

		toastr()->success('Succes', 'The plan has been made');

		return redirect()->route('index');
	}
}
