<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivityWorkList extends Model
{
    use HasFactory;
    protected $table = 'dailyactivities_work_list';
    protected $fillable = [
        'daily_activity_id',
        'employee_id',
        'Updated_Work',
        'cancel'
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
