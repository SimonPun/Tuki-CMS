<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable; // Import the Notifiable trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable; // Include the Notifiable trait

    protected $fillable = [
        'name', 'email', 'phone', 'city', 'position', 'start_date', 'image', 'linkedin', 'facebook',
    ];
    protected $hidden = [
        'password',
    ];
    // Relationship with DailyActivity (One-to-Many)
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class, 'employee_id');
    }

    // Relationship with DailyActivity through activity_colleague (Many-to-Many)
    public function activities()
    {
        return $this->hasMany(DailyActivity::class, 'employee_id');
    }
    public function workLists()
    {
        return $this->hasMany(DailyActivityWorkList::class, 'employee_id');
    }
}
