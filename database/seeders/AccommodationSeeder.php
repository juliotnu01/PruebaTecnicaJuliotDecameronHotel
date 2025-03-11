<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accommodation::factory()->create(['nombre' => 'Sencilla']);
        Accommodation::factory()->create(['nombre' => 'Doble']);
        Accommodation::factory()->create(['nombre' => 'Triple']);
        Accommodation::factory()->create(['nombre' => 'Cuádruple']);
    }
}
