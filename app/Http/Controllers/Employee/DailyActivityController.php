<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyActivity;

class DailyActivityController extends Controller
{
    public function index()
    {
        // Retrieve all daily activities for the authenticated user
        $dailyActivities = DailyActivity::where("user_id", auth()->user()->id)->latest()->paginate(10);
        return view('user.dailyactivities.index', compact('dailyActivities'));
    }

    public function create()
    {
        // Return view to create a new daily activity
        return view('user.dailyactivities.create');
    }

    public function store(Request $request)
    {
        return $request;
        // Validate the request data
        // $request->validate([
        //     'employee_id' => 'required|exists:employees,id',
        //     'title' => 'required|string|max:255',
        //     'check_in' => 'nullable|string|max:255',
        //     'checkout' => 'nullable|string|max:255',
        //     'work_status' => 'nullable|in:0,1,2', // assuming work_status can be 0, 1, or 2
        //     'work_list' => 'nullable|string',
        //     'finished_work' => 'nullable|string',
        //     'remaining_work' => 'nullable|string',
        //     'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048', // example file validation
        // ]);
        $dailyactivities = new DailyActivity;
        // Handle file upload if any
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $dailyactivities->file = $fileName;
        } else {
            $dailyactivities = null;
        }
        $dailyactivities->employee_id = $request->employee_id;
        $dailyactivities->title = $request->title;
        $dailyactivities->check_in = $request->check_in;
        $dailyactivities->checkout = $request->check_out;
        $dailyactivities->work_status = $request->work_status;
        $dailyactivities->work_list = $request->work_list;
        $dailyactivities->finished_work = $request->finished_work;
        $dailyactivities->remaining_work = $request->remaining_work;
        $dailyactivities->save();

        // Redirect to a specific route with success message
        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity added successfully!');
    }
    public function show($id)
    {
        // Retrieve and show a specific daily activity
        $dailyActivity = DailyActivity::findOrFail($id);
        return view('user.dailyactivities.show', compact('dailyActivity'));
    }

    public function edit($id)
    {
        // Retrieve and return view to edit a specific daily activity
        $dailyActivity = DailyActivity::findOrFail($id);
        return view('user.dailyactivities.edit', compact('dailyActivity'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'nullable|string|max:255',
            'checkout' => 'nullable|string|max:255',
            'work_status' => 'nullable|string|max:255',
            'work_list' => 'nullable|string',
            'finished_work' => 'nullable|string',
            'remaining_work' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // Example max file size of 10MB
        ]);

        // Find the DailyActivity instance by ID
        $dailyActivity = DailyActivity::findOrFail($id);

        // Ensure the authenticated user owns this daily activity
        if ($dailyActivity->employee_id !== auth()->user()->id) {
            return redirect()->route('dailyactivities.index')->with('error', 'Unauthorized action.');
        }

        // Update DailyActivity instance with new data
        $dailyActivity->fill($request->all());

        // Handle file upload if provided
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $dailyActivity->file = $fileName;
        }

        // Save updated DailyActivity instance
        try {
            $dailyActivity->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update daily activity: ' . $e->getMessage());
        }

        // Redirect back with success message
        return redirect()->route('dailyactivities.index')
            ->with('success', 'Daily Activity updated successfully.');
    }

    public function destroy($id)
    {
        // Find the DailyActivity instance by ID
        $dailyActivity = DailyActivity::findOrFail($id);

        // Ensure the authenticated user owns this daily activity
        if ($dailyActivity->employee_id !== auth()->user()->id) {
            return redirect()->route('dailyactivities.index')->with('error', 'Unauthorized action.');
        }

        // Delete the DailyActivity instance
        try {
            $dailyActivity->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete daily activity: ' . $e->getMessage());
        }

        // Redirect back with success message
        return redirect()->route('dailyactivities.index')
            ->with('success', 'Daily Activity deleted successfully.');
    }
}
