<?php

namespace App\Services\Task;

use Illuminate\Support\Facades\Http;

class TaskService implements TaskServiceInterface
{
	public array $data = [];
	public string $url;

	public function __construct(string $url)
	{
		$this->url = $url;
	}

	public function getData(): array
	{
		$client = Http::get($this->url);

		if ($client->successful()) {
			$this->data = $client->json();
		}

		return $this->data;
	}
}