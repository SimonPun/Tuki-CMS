<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'check_in',
        'checkout',
        'work_status',
        'work_list',
        'finished_work',
        'remaining_work',
        'file',
    ];

    /**
     * Get the employee that owns the daily activity.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
