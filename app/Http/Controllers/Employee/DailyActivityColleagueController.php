<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityColleague;
use Illuminate\Support\Facades\Auth;

class DailyActivityColleagueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        // Render the view with the form to submit new activity status
        return view('employee.Dailyactivities.create'); // Adjust path as needed
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daily_activity_id' => 'required|exists:daily_activities,id',
            'employee_id' => 'required|exists:employees,id',
            'work_status' => 'nullable|integer|in:0,1,2,3',
            'remarks' => 'nullable|string|max:255',
        ]);

        $status = $validated['work_status'] ?? 0;

        ActivityColleague::updateOrCreate(
            [
                'daily_activity_id' => $validated['daily_activity_id'],
                'employee_id' => $validated['employee_id'],
            ],
            [
                'work_status' => $status,
                'remarks' => $validated['remarks'],
            ]
        );

        return redirect()->back()->with('success', 'Activity added successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'remarks' => 'nullable|string|max:255',
            'work_status' => 'required|integer|in:0,1,2,3',
        ]);

        $activityColleague = ActivityColleague::where('daily_activity_id', $id)
            ->where('employee_id', Auth::id())
            ->first();

        if ($activityColleague) {
            $activityColleague->update([
                'remarks' => $validated['remarks'],
                'work_status' => $validated['work_status'],
            ]);

            return redirect()->back()->with('success', 'Activity status updated successfully.');
        }
    }
}
