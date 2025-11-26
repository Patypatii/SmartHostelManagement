<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'student_id',
        'gender',
        'course',
        'year_of_study',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is student
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Get bookings for this user
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get payments for this user
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get complaints for this user
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Get visitors hosted by this user
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'host_user_id');
    }

    /**
     * Get complaints assigned to this staff member
     */
    public function assignedComplaints()
    {
        return $this->hasMany(Complaint::class, 'assigned_to');
    }
}
