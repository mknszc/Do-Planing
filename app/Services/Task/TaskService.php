<?php

namespace App\Services\Task;

use Illuminate\Support\Facades\Http;

class TaskService implements TaskServiceInterface
{
	public string $url;

	public function __construct(string $url)
	{
		$this->url = $url;
	}

	public function getData(): array
	{
		$data = [];
		$client = Http::get($this->url);

		if ($client->successful()) {
			$data = $client->json();
		}

		return $data;
	}
}
