<?php

namespace Database\Seeders;

use App\Models\HostelBlock;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = HostelBlock::all();

        foreach ($blocks as $block) {
            // Create 10 rooms per floor for 4 floors
            for ($floor = 1; $floor <= $block->total_floors; $floor++) {
                for ($roomNum = 1; $roomNum <= 10; $roomNum++) {
                    // Format room number like A101, A102... B201, B202...
                    $roomCode = substr($block->name, -1) . $floor . str_pad($roomNum, 2, '0', STR_PAD_LEFT);
                    
                    Room::create([
                        'block_id' => $block->id,
                        'room_number' => $roomCode,
                        'floor' => $floor,
                        'capacity' => 2, // Double rooms
                        'occupied' => 0,
                        'room_type' => 'double',
                        'price_per_semester' => 15000.00,
                        'has_bathroom' => true,
                        'has_balcony' => ($floor > 1), // Upper floors have balconies
                        'status' => 'available',
                    ]);
                }
            }
        }
    }
}
