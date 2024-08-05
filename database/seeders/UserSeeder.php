<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nom' => "Biteye",
                'prenom' => "Ndeye",
                'email' => "ndeye@gmail.com",
                "role" => "admin",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],

            [
                'nom' => "Talla",
                'prenom' => "Cheikh Saliou",
                'email' => "cheikhSaliou@gmail.com",
                "role" => "personnel",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'nom' => "Kane",
                'prenom' => "Marieme",
                'email' => "marieme@gmail.com",
                "role" => "personnel",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'nom' => "Ba",
                'prenom' => "Magid",
                'email' => "magid@gmail.com",
                "role" => "membre",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'nom' => "Diallo",
                'prenom' => "Alpha",
                'email' => "alpha@gmail.com",
                "role" => "membre",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'nom' => "Diaw",
                'prenom' => "Yaye Rokhate",
                'email' => "yaye@gmail.com",
                "role" => "membre",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
