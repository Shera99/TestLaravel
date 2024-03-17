<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{User,Project, ProjectUserRole};


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(5)->create();

         Project::factory(1)->create([
             "name" => "Project 1",
             "uuid" => (string) Str::uuid(),
             "description" => "Fake description",
             "creator_id" => 1
         ]);

        $users = [
            ['id' => 1, 'role' => UserRole::FULL_ACCESS],
            ['id' => 2, 'role' => UserRole::FULL_ACCESS],
            ['id' => 3, 'role' => UserRole::EDITING],
            ['id' => 4, 'role' => UserRole::READING],
        ];

        foreach ($users as $user) {
            ProjectUserRole::factory(1)->create([
                "project_id" => 1,
                "user_id" => $user['id'],
                "role" => $user['role']
            ]);
        }

    }
}
