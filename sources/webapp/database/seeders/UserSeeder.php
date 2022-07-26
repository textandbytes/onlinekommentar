<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->count(10)
            ->create();

        $users->each(function ($user) {
            $user->assignRole('admin');
        });

        User::factory()
        ->count(90)
        ->create();

    }
}
