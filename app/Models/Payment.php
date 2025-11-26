<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'transaction_reference',
        'amount',
        'payment_method',
        'phone_number',
        'status',
        'payment_details',
        'paid_at',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Boot method to generate transaction reference
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($payment) {
            if (empty($payment->transaction_reference)) {
                $payment->transaction_reference = 'TXN-' . strtoupper(Str::random(12));
            }
        });
    }

    /**
     * Get the booking for this payment
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user who made this payment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who verified this payment
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if payment is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is verified
     */
    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }
}
