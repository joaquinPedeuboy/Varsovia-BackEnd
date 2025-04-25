<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SexoSeeder;
use Database\Seeders\TallaSeeder;
use Database\Seeders\CategoriaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriaSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(TallaSeeder::class);
    }
}
