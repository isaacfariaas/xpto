<?php

namespace Database\Seeders;

use App\Models\Winner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WinnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Winner::factory(30)->create();
    }
}
