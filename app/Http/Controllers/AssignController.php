<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Repositories\AssignRepository;

/**
 * @property TaskRepository $taskRepository
 * @property AssignRepository $assignRepository
 */
class AssignController extends Controller
{
	public function __construct(
		TaskRepository $taskRepository,
		AssignRepository $assignRepository)
	{
		$this->taskRepository = $taskRepository;
		$this->assignRepository = $assignRepository;
	}

	public function index()
	{
		$tasks = $this->taskRepository->getAllwithDeveloper();

		return view('assign', compact('tasks'));
	}

	public function assignTask()
	{
		$this->assignRepository->assignTaskAndSave();

		toastr()->success('Succes', 'The plan has been made');

		return redirect()->route('index');
	}
}
