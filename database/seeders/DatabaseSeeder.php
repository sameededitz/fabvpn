<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Plan;
use App\Models\Purchase;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserFeedback;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->admin()->create();
        // User::factory()->user()->create();

        // Plan::factory(10)->create();
        // Purchase::factory(50)->create();
        UserFeedback::factory(50)->create();
    }
}
