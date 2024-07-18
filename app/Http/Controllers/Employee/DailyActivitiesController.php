<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyActivity;
use Illuminate\Support\Facades\Auth;

class DailyActivitiesController extends Controller
{
    public function index()
    {
        // Fetch all daily activities for the logged-in employee
        $activities = DailyActivity::where('employee_id', Auth::guard('employee')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass $activities to the view
        return view('employee.dailyactivities.index', compact('activities'));
    }

    public function create()
    {
        return view('employee.dailyactivities.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required',
            'checkout' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            'work_status' => 'required|integer',
            'work_list' => 'required|string|max:255',
            'finished_work' => 'required|string|max:255',
            'remaining_work' => 'required|string|max:255',
        ]);

        // Store data logic
        $dailyActivity = new DailyActivity();
        $dailyActivity->employee_id = Auth::guard('employee')->user()->id;
        $dailyActivity->title = $request->input('title');
        $dailyActivity->check_in = $request->input('check_in');
        $dailyActivity->checkout = $request->input('checkout');
        $dailyActivity->work_status = $request->input('work_status');
        $dailyActivity->work_list = $request->input('work_list');
        $dailyActivity->finished_work = $request->input('finished_work');
        $dailyActivity->remaining_work = $request->input('remaining_work');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $dailyActivity->file = $filePath;
        }

        $dailyActivity->save();

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity added successfully.');
    }

    public function edit($id)
    {
        // Find the daily activity by ID
        $activity = DailyActivity::findOrFail($id);

        // Ensure the user can only edit their own activities
        if ($activity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403); // Unauthorized
        }

        // Pass $activity to the view
        return view('employee.dailyactivities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        // Find the daily activity by ID
        $dailyActivity = DailyActivity::findOrFail($id);

        // Ensure the user can only update their own activities
        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403); // Unauthorized
        }

        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required',
            'checkout' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            'work_status' => 'required|integer',
            'work_list' => 'required|string|max:255',
            'finished_work' => 'required|string|max:255',
            'remaining_work' => 'required|string|max:255',
        ]);

        // Update data logic
        $dailyActivity->title = $request->input('title');
        $dailyActivity->check_in = $request->input('check_in');
        $dailyActivity->checkout = $request->input('checkout');
        $dailyActivity->work_status = $request->input('work_status');
        $dailyActivity->work_list = $request->input('work_list');
        $dailyActivity->finished_work = $request->input('finished_work');
        $dailyActivity->remaining_work = $request->input('remaining_work');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $dailyActivity->file = $filePath;
        }

        $dailyActivity->save();

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity updated successfully.');
    }

    public function destroy($id)
    {
        // Find the daily activity by ID
        $dailyActivity = DailyActivity::findOrFail($id);

        // Ensure the user can only delete their own activities
        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403); // Unauthorized
        }

        // Delete the daily activity
        $dailyActivity->delete();

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity deleted successfully.');
    }
}
