<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityColleague extends Model
{
    use HasFactory;
    protected $fillable = [
        "daily_activity_id",
        "employee_id",
        "work_status",
        "remarks",
    ];

    public function dailyActivity()
    {
        return $this->belongsTo(DailyActivity::class, 'daily_activity_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
