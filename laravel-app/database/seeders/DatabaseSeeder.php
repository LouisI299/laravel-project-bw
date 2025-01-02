<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Password!123'), // Ensure you set a password
                'is_admin' => true,
            ]
        );

        $users->each(function (User $user) {
            $user->posts()->saveMany(
                Post::factory(5)->make()
            );
        });

        $admin->posts()->saveMany(
            Post::factory(5)->make()
        );
    }
}