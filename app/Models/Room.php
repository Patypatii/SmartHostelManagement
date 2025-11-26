<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'room_number',
        'floor',
        'capacity',
        'occupied',
        'room_type',
        'price_per_semester',
        'description',
        'has_bathroom',
        'has_balcony',
        'status',
    ];

    protected $casts = [
        'price_per_semester' => 'decimal:2',
        'has_bathroom' => 'boolean',
        'has_balcony' => 'boolean',
    ];

    /**
     * Get the hostel block this room belongs to
     */
    public function block()
    {
        return $this->belongsTo(HostelBlock::class, 'block_id');
    }

    /**
     * Get bookings for this room
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get complaints for this room
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Get visitors to this room
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    /**
     * Check if room is available
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->occupied < $this->capacity;
    }

    /**
     * Get remaining capacity
     */
    public function getRemainingCapacity(): int
    {
        return $this->capacity - $this->occupied;
    }

    /**
     * Update room status based on occupancy
     */
    public function updateStatus(): void
    {
        if ($this->occupied >= $this->capacity) {
            $this->status = 'full';
        } elseif ($this->occupied > 0) {
            $this->status = 'occupied';
        } else {
            $this->status = 'available';
        }
        $this->save();
    }
}
