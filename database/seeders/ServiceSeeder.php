<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create(['name' => 'comptabilité']);
        Service::create(['name' => 'RH']);
        Service::create(['name' => 'maintenance']);

        // User::find(2)->assignService(1);
        // User::find(3)->assignService(2);
        // User::find(4)->assignService(3);
        // User::find(5)->assignService(1);
        // User::find(6)->assignService(2);
        // User::find(7)->assignService(3);
        // User::find(8)->assignService(1);
        // User::find(9)->assignService(2);
        // User::find(10)->assignService(3);
    }
}
