<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_user_id',
        'room_id',
        'visitor_name',
        'visitor_phone',
        'visitor_id_number',
        'purpose_of_visit',
        'entry_time',
        'expected_exit_time',
        'actual_exit_time',
        'status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected $casts = [
        'entry_time' => 'datetime',
        'expected_exit_time' => 'datetime',
        'actual_exit_time' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the host user
     */
    public function host()
    {
        return $this->belongsTo(User::class, 'host_user_id');
    }

    /**
     * Get the room being visited
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the staff who approved this visitor
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if visitor is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved' || $this->status === 'checked_in';
    }

    /**
     * Check if visitor is checked in
     */
    public function isCheckedIn(): bool
    {
        return $this->status === 'checked_in';
    }

    /**
     * Check if visitor has checked out
     */
    public function hasCheckedOut(): bool
    {
        return $this->status === 'checked_out';
    }

    /**
     * Check if visitor is pending approval
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
