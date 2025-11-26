<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'gender',
        'total_floors',
        'total_rooms',
        'description',
        'status',
    ];

    /**
     * Get the rooms in this hostel block
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'block_id');
    }

    /**
     * Get available rooms in this block
     */
    public function availableRooms()
    {
        return $this->rooms()->where('status', 'available');
    }

    /**
     * Get occupancy statistics
     */
    public function getOccupancyRate()
    {
        $totalCapacity = $this->rooms()->sum('capacity');
        $occupied = $this->rooms()->sum('occupied');
        
        return $totalCapacity > 0 ? ($occupied / $totalCapacity) * 100 : 0;
    }
}
