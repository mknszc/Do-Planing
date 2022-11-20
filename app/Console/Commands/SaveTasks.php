<?php

namespace App\Console\Commands;

use App\Services\Task\TaskManager;
use App\Models\Task;
use Exception;
use Illuminate\Console\Command;

class SaveTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save Tasks with Task Service';

	/**
	 * @throws Exception
	 */
	public function insert()
	{
		$data = (new TaskManager())->getTasks();

		try {
			Task::insert($data);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * @throws Exception
	 */
	public function handle(): bool
	{
		$this->info('Adding data');
		$this->insert();
		$this->info('Successfully');

		return true;
	}
}
