<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Agent User',
            'email' => 'agent@agent.com',
        ]);

        $this->call([
            CategoriesSeeder::class,
            PrioritiesSeeder::class,
            RolesSeeder::class,
            ServiceSeeder::class,
            StatusesSeeder::class,
        ]);

        \App\Models\User::factory(10)
            ->create()
            ->each(fn ($user) => $user->assignRole('user'));
   }
}
