<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();

        User::updateOrCreate([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password', [
                'rounds' => 12,
            ])
        ]);
    }
}
