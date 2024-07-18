<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'phone', 'position', 'password', 'city', 'linkedin', 'facebook',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define the relationship to Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Define the relationship to DailyActivity
    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }
}
