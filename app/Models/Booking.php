<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'booking_reference',
        'start_date',
        'end_date',
        'total_amount',
        'status',
        'notes',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    /**
     * Boot method to generate booking reference
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'BK-' . strtoupper(Str::random(10));
            }
        });
    }

    /**
     * Get the user who made this booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the room for this booking
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the admin who approved this booking
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get payments for this booking
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if booking is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if booking is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is complete
     */
    public function isPaymentComplete(): bool
    {
        $totalPaid = $this->payments()->where('status', 'completed')->sum('amount');
        return $totalPaid >= $this->total_amount;
    }
}
