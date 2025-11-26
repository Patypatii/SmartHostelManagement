<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'complaint_number',
        'title',
        'description',
        'category',
        'priority',
        'status',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'resolution_notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Boot method to generate complaint number
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($complaint) {
            if (empty($complaint->complaint_number)) {
                $complaint->complaint_number = 'CMP-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the user who filed this complaint
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the room this complaint is about
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the staff member assigned to this complaint
     */
    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Check if complaint is resolved
     */
    public function isResolved(): bool
    {
        return $this->status === 'resolved' || $this->status === 'closed';
    }

    /**
     * Check if complaint is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if complaint is assigned
     */
    public function isAssigned(): bool
    {
        return !is_null($this->assigned_to);
    }
}
