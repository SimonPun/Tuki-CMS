<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'position', 'password', 'city', 'linkedin', 'facebook', 'image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the tasks associated with the employee.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the daily activities associated with the employee.
     */
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }

    /**
     * Get the activities associated with the employee.
     */
    public function activities()
    {
        return $this->hasMany(DailyActivity::class);
    }
}
