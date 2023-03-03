<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->truncate();

        Genre::create(['name' => 'Classic', 'description' => 'Popular']);
        Genre::create(['name' => 'Jazz', 'description' => 'Jazz']);
        Genre::create(['name' => 'Pop', 'description' => 'Pop']);
        Genre::create(['name' => 'Flat', 'description' => 'Flat']);
    }
}
