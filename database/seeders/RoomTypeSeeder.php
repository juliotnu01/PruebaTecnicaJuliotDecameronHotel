<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::factory()->create(['nombre' => 'Estándar']);
        RoomType::factory()->create(['nombre' => 'Junior']);
        RoomType::factory()->create(['nombre' => 'Suite']);
    }
}
