<?php

namespace Database\Seeders;

use App\Models\HostelBlock;
use Illuminate\Database\Seeder;

class HostelBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelBlock::create([
            'name' => 'Block A',
            'code' => 'BLK-A',
            'gender' => 'male',
            'total_floors' => 4,
            'total_rooms' => 40,
            'description' => 'Main hostel block for male students',
            'status' => 'active',
        ]);

        HostelBlock::create([
            'name' => 'Block B',
            'code' => 'BLK-B',
            'gender' => 'female',
            'total_floors' => 4,
            'total_rooms' => 40,
            'description' => 'Main hostel block for female students',
            'status' => 'active',
        ]);
    }
}
