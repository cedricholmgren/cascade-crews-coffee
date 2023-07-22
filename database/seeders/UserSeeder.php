<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //run user seeder 10 times
        User::factory()->count(10)->create();
        //create a user with a specific email
        User::factory()->create([
            'email' => 'cedricholmgren@gmail.com',
        ]);
    }
}
