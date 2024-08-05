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
        Categorie::factory(9)->create();
        $this->call(UserSeeder::class);
        Livre::factory(20)->create();
        Emprunt::factory(15)->create();
    }
}
