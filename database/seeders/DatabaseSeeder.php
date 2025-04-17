<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Server;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->admin()->create();
        // User::factory()->user()->create();
        
        User::factory(50)->create();

        // Plan::factory(100)->create();
    }
}
