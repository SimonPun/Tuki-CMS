<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable; // Import the Notifiable trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable; // Include the Notifiable trait

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city', 'position', 'start_date', 'image', 'linkedin', 'facebook',
    ];

    // Relationship with DailyActivity (One-to-Many)
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }

    // Relationship with DailyActivity through activity_colleague (Many-to-Many)
    public function mentionedActivities()
    {
        return $this->belongsToMany(DailyActivity::class, 'activity_colleague');
    }
}
