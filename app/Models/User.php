<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'date_of_birth',
        'gender',
        'location',
        'bio',
        'phone_number',
        'availability',
        'hourly_rate',
        'is_escort',
        'is_verified',
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
        'is_escort' => 'boolean',
        'is_verified' => 'boolean',
        'hourly_rate' => 'decimal:2',
    ];

    /**
     * Get all subscriptions associated with the user.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the current subscription plan associated with the user through the latest subscription.
     */
    public function subscriptionPlan(): HasOneThrough
    {
        return $this->hasOneThrough(SubscriptionPlan::class, Subscription::class);
    }

    /**
     * Accessor for full name (Ensure you have first_name and last_name in the database).
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name; // Adjust if using a different field for name
    }

    /**
     * Scope for verified users.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Accessor for formatted phone number.
     */
    public function getFormattedPhoneNumberAttribute(): string
    {
        return '(' . substr($this->phone_number, 0, 3) . ') ' . substr($this->phone_number, 3, 3) . '-' . substr($this->phone_number, 6);
    }

    /**
     * Update profile image method.
     */
    public function updateProfileImage($image)
    {
        $path = $image->store('profile_images', 'public');
        $this->update(['profile_image' => $path]);
    }

    /**
     * Accessor for age based on date_of_birth (If `date_of_birth` exists in your database).
     */
    public function getAgeAttribute(): int
    {
        return now()->diffInYears($this->date_of_birth); // Ensure date_of_birth is defined, or remove this accessor
    }
    
    public function lastMessageWith($authUserId)
{
    return Message::where(function ($query) use ($authUserId) {
        $query->where('sender_id', $this->id)
            ->where('receiver_id', $authUserId);
    })
    ->orWhere(function ($query) use ($authUserId) {
        $query->where('sender_id', $authUserId)
            ->where('receiver_id', $this->id);
    })
    ->latest()
    ->first();
}

    



}
