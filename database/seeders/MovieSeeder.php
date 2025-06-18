<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users=\App\Models\User::factory(10)->create();
         \App\Models\User::factory()->create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('admin123')
         ]);

        \App\Models\Movie::factory(50)->create([
            'user_id'=> fn()=> $users->random()->id
        ]);
    }
}
