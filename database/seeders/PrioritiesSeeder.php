<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $priorities = [
            'Low', 'Medium', 'High'
        ];

        foreach($priorities as $priority)
        {
            if($priority == 'Low'){
                $color = '#6c757d';
            }
            if($priority == 'Medium'){
                $color = '#ffc107';
            }
            if($priority == 'High'){
                $color = '#dc3545';
            }
            Priority::create([
                'name'  => $priority,
                'color' =>  $color 
            ]);
        }
    }
}
