<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
	    for ($i = 1; $i < 6; $i++) {
		    DB::table('developers')->insert([
			    'name' => 'DEV' . $i,
			    'level' => $i,
			    'weekly_capacity' => 45,
			    'created_at' => now(),
			    'updated_at' => now()
		    ]);
	    }
    }
}
