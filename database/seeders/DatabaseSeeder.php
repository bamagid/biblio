<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(6)->create();
        Categorie::factory(5)->create();
        Livre::factory(10)->create();
        Emprunt::factory(6)->create();
    }
}
