<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityColleague;
use App\Models\DailyActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DailyActivityColleagueController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Render the view with the form to submit new activity status
        return view('employee.Dailyactivities.create'); // Adjust path as needed
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daily_activity_id' => 'required|exists:daily_activities,id',
            'employee_id' => 'required|exists:employees,id',
            'work_status' => 'nullable|integer|in:0,1,2,3',
            'remarks' => 'nullable|string|max:255',
        ]);

        // Set a default status if not provided
        $status = $validated['work_status'] ?? 0; // Default to 'Not Started'

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {

        // return $request->all();



        $validated = $request->validate([
            'remarks' => 'nullable|string|max:255',
            'work_status' => 'required|integer|in:0,1,2,3',
        ]);

        // Find the record in the activity_colleagues table
        $activityColleague = ActivityColleague::where('daily_activity_id', $id)
            ->where('employee_id', Auth::id())
            ->first();




        if ($activityColleague) {
            $activityColleague->update([
                'remarks' => $validated['remarks'],
                'work_status' => $validated['work_status'],
            ]);
        } else {
            return redirect()->back()->with('error', 'Activity not found or access denied.');
        }


        return redirect()->to('/employee/dailyactivities')->with('success', 'Status updated successfully.');
    }
}
