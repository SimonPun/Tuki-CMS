<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'title', 'check_in', 'checkout', 'work_status',
        'work_list', 'finished_work', 'remaining_work', 'file'
    ];

    /**
     * Get the employee that created the daily activity.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the colleagues associated with the daily activity.
     */
    public function colleagues()
    {
        return $this->belongsToMany(Employee::class, 'activity_colleagues', 'daily_activity_id', 'employee_id');
    }

    public function activities()
    {
        return $this->hasMany(ActivityColleague::class, 'daily_activity_id');
    }

    public function workLists()
    {
        return $this->hasMany(DailyActivityWorkList::class, 'daily_activity_id');
    }
}