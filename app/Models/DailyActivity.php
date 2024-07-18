<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
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

    // Define the relationship to Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
