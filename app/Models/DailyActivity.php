<?php

// app/Models/DailyActivity.php

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

    // Relationship with Employee (One-to-Many)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Relationship with Employee through activity_colleague (Many-to-Many)
    public function colleagues()
    {
        return $this->belongsToMany(Employee::class, 'activity_colleague');
    }
}