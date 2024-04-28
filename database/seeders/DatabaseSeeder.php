<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Task;
use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Company::factory(3)
        ->has(Meeting::factory(2))
        ->has(Project::factory(2))
        ->has(User::factory(6))
        ->create();
    }
}
