<?php

return [
	'providersOne' => [
		'url' => 'https://www.mocky.io/v2/5d47f24c330000623fa3ebfa',
		'level' => 'zorluk',
		'task_id' => 'id',
		'duration' => 'sure',
		'depth' => 1,
		'design' => [
			[   'level' => 'zorluk',
				'duration' => 'sure',
				'task_id' => 'id'
			],
		]
	],

	'providersTwo' => [
		'url' => 'https://www.mocky.io/v2/5d47f235330000623fa3ebf7',
		'depth' => 2,
		'level' => 'level',
		'task_id' => 0,
		'duration' => 'estimated_duration',
		'design' => [
			['task_id' =>
				[
					'level' => 'level',
					'duration' => 'estimated_duration'
				],
			],
		]
	]
];