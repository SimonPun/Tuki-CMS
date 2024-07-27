<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyActivity;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DailyActivitiesController extends Controller
{
    public function index()
    {
        $employeeId = Auth::guard('employee')->user()->id;

        // Retrieve activities where the employee is either the owner or mentioned as a colleague
        $activities = DailyActivity::where(function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId)
                ->orWhereHas('colleagues', function ($query) use ($employeeId) {
                    $query->where('employee_id', $employeeId);
                });
        })->with('colleagues')->orderBy('created_at', 'desc')->get();

        return view('employee.dailyactivities.index', compact('activities'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('employee.dailyactivities.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required|date',
            'checkout' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            'work_status' => 'required|integer',
            'work_list' => 'required|string|max:255',
            'finished_work' => 'required|string|max:255',
            'remaining_work' => 'required|string|max:255',
            'colleagues' => 'nullable|array',
            'colleagues.*' => 'exists:employees,id'
        ]);

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

        // Attach colleagues if provided
        if ($request->has('colleagues')) {
            $dailyActivity->colleagues()->attach($request->input('colleagues'));
        }

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity added successfully.');
    }

    public function edit($id)
    {
        $activity = DailyActivity::findOrFail($id);

        if ($activity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        $employees = Employee::all();
        $selectedColleagues = $activity->colleagues->pluck('id')->toArray();

        return view('employee.dailyactivities.update', compact('activity', 'employees', 'selectedColleagues'));
    }

    public function update(Request $request, $id)
    {
        $dailyActivity = DailyActivity::findOrFail($id);

        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required|date',
            'checkout' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            'work_status' => 'required|integer',
            'work_list' => 'required|string|max:255',
            'finished_work' => 'required|string|max:255',
            'remaining_work' => 'required|string|max:255',
            'colleagues' => 'nullable|array',
            'colleagues.*' => 'exists:employees,id'
        ]);

        $dailyActivity->title = $request->input('title');
        $dailyActivity->check_in = $request->input('check_in');
        $dailyActivity->checkout = $request->input('checkout');
        $dailyActivity->work_status = $request->input('work_status');
        $dailyActivity->work_list = $request->input('work_list');
        $dailyActivity->finished_work = $request->input('finished_work');
        $dailyActivity->remaining_work = $request->input('remaining_work');

        if ($request->hasFile('file')) {
            if ($dailyActivity->file && Storage::exists('public/' . $dailyActivity->file)) {
                Storage::delete('public/' . $dailyActivity->file);
            }
            $filePath = $request->file('file')->store('uploads', 'public');
            $dailyActivity->file = $filePath;
        }

        $dailyActivity->save();

        // Sync colleagues if provided
        if ($request->has('colleagues')) {
            $dailyActivity->colleagues()->sync($request->input('colleagues'));
        } else {
            $dailyActivity->colleagues()->detach();
        }

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity updated successfully.');
    }

    public function destroy($id)
    {
        $dailyActivity = DailyActivity::findOrFail($id);

        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        if ($dailyActivity->file && Storage::exists('public/' . $dailyActivity->file)) {
            Storage::delete('public/' . $dailyActivity->file);
        }

        $dailyActivity->delete();

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity deleted successfully.');
    }

    public function download($id)
    {
        $activity = DailyActivity::findOrFail($id);

        if ($activity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        if ($activity->file) {
            $filePath = storage_path('app/public/' . $activity->file);
            $fileName = basename($filePath);

            return response()->download($filePath, $fileName);
        }

        return redirect()->back()->withErrors(['error' => 'File not found.']);
    }
}