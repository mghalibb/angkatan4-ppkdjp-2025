<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     "name" => "Ghalib",
        //     "email" => "ghalib@gmail.com",
        //     "password" => "12345"
        // ]);

        // User::factory()->create([
        //     'name' => 'Ghalib',
        //     'email' => 'ghalib123@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('admin123'),
        //     'remember_token' => Str::random(10)
        // ]);

        $feker = Factory::create("id_ID");
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                "name" => $feker->name(),
                "email" => $feker->email(),
                "email_verified_at" => now(),
                "password" => Hash::make("12345"),
                "remember_token" => Str::random(10)
            ]);
        }
    }
}
