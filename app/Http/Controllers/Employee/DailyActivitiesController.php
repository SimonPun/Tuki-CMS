<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ActivityColleague;
use Illuminate\Http\Request;
use App\Models\DailyActivity;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DailyActivitiesController extends Controller
{


    /**
     * Display a listing of the daily activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeId = Auth::guard('employee')->user()->id;



        $activities = DB::table('daily_activities')
            ->join('activity_colleagues', 'daily_activities.id', '=', 'activity_colleagues.daily_activity_id')
            ->join('employees', 'employees.id', '=', 'activity_colleagues.employee_id')
            ->select('daily_activities.*')
            ->where('employees.id', $employeeId)
            ->paginate(10);

        $activitiesWithColleagues = [];

        foreach ($activities as $activity) {
            $activityColleagues = DB::table('activity_colleagues')
                ->join('employees', 'employees.id', '=', 'activity_colleagues.employee_id')
                ->select(
                    'activity_colleagues.work_status',
                    'employees.name as employee_name', // Example field from employees
                    // Example field from employees
                    'remarks'
                )
                ->where('activity_colleagues.daily_activity_id', $activity->id)
                ->get();

            // Combine activity and colleagues' data
            $activitiesWithColleagues[] = [
                'activity' => $activity,
                'colleagues' => $activityColleagues
            ];
        }


        return view('employee.dailyactivities.index', [
            'activities' => $activitiesWithColleagues,
            'pagination' => $activities
        ]);
    }

    /**
     * Show the form for creating a new daily activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('id', '!=', Auth::guard('employee')->user()->id)->get();
        return view('employee.dailyactivities.create', compact('employees'));
    }

    /**
     * Store a newly created daily activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required|date',
            'checkout' => 'nullable|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            // 'work_status' => 'required|integer',
            'work_list' => 'nullable|string|max:255',
            'finished_work' => 'nullable|string|max:255',
            'remaining_work' => 'nullable|string|max:255',
            'colleagues' => 'nullable|array',
            'colleagues.*' => 'exists:employees,id'
        ]);

        $dailyActivity = new DailyActivity();
        $dailyActivity->employee_id = Auth::guard('employee')->user()->id;
        $dailyActivity->title = $request->input('title');
        $dailyActivity->check_in = $request->input('check_in');
        $dailyActivity->checkout = $request->input('checkout');
        // $dailyActivity->work_status = $request->input('work_status');
        $dailyActivity->work_list = $request->input('work_list');
        $dailyActivity->finished_work = $request->input('finished_work');
        $dailyActivity->remaining_work = $request->input('remaining_work');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $dailyActivity->file = $filePath;
        }

        $dailyActivity->save();


        $dailyactivitycoulege = new ActivityColleague();
        $dailyactivitycoulege->daily_activity_id =  $dailyActivity->id;
        $dailyactivitycoulege->employee_id = Auth::guard('employee')->user()->id;
        $dailyactivitycoulege->work_status = 0;
        $dailyactivitycoulege->remarks = null;
        $dailyactivitycoulege->save();




        if ($request->input('colleagues')) {
            foreach ($request->input('colleagues') as $key => $value) {
                $dailyactivitycoulege = new ActivityColleague();
                $dailyactivitycoulege->daily_activity_id =  $dailyActivity->id;
                $dailyactivitycoulege->employee_id = $value;
                $dailyactivitycoulege->work_status = 0;
                $dailyactivitycoulege->remarks = null;
                $dailyactivitycoulege->save();
            }
        }


        // Attach colleagues if provided
        // if ($request->has('colleagues')) {
        //     $dailyActivity->colleagues()->attach($request->input('colleagues'));
        // }

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity added successfully.');
    }

    /**
     * Show the form for editing the specified daily activity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = DailyActivity::findOrFail($id);

        // Ensure only the creator can edit the activity
        if ($activity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        $employees = Employee::where('id', '!=', Auth::guard('employee')->user()->id)->get();
        $selectedColleagues = $activity->colleagues->pluck('id')->toArray();

        return view('employee.dailyactivities.update', compact('activity', 'employees', 'selectedColleagues'));
    }

    /**
     * Update the specified daily activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dailyActivity = DailyActivity::findOrFail($id);

        // Ensure only the creator can update the activity
        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'check_in' => 'required|date',
            'checkout' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            // 'work_status' => 'required|integer',
            'work_list' => 'nullable|string|max:255',
            'finished_work' => 'nullable|string|max:255',
            'remaining_work' => 'nullable|string|max:255',
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
            // Delete old file if exists
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

    /**
     * Remove the specified daily activity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dailyActivity = DailyActivity::findOrFail($id);

        if ($dailyActivity->employee_id !== Auth::guard('employee')->user()->id) {
            abort(403);
        }

        // Delete file if exists
        if ($dailyActivity->file && Storage::exists('public/' . $dailyActivity->file)) {
            Storage::delete('public/' . $dailyActivity->file);
        }

        $dailyActivity->delete();

        return redirect()->route('dailyactivities.index')->with('success', 'Daily activity deleted successfully.');
    }

    /**
     * Download the file for the specified daily activity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $activity = DailyActivity::findOrFail($id);

        // Ensure only the creator can download the file
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


    public function status($id)
    {
        $activities = DB::table('daily_activities')
            ->join('activity_colleagues', 'daily_activities.id', '=', 'activity_colleagues.daily_activity_id')
            ->join('employees', 'activity_colleagues.employee_id', '=', 'employees.id')
            ->where('daily_activities.id', $id)
            ->select('daily_activities.title', 'employees.name as employee_name', 'activity_colleagues.work_status')
            ->get();

        return view('employee.dailyactivities.status', ['activities' => $activities]);
    }

    public function action(Request $request, $id)
    {
        $activity = DailyActivity::findOrFail($id);
        $activityCollgeData = ActivityColleague::select('*')->where('daily_activity_id', $id)->where('employee_id', Auth::guard('employee')->user()->id)->get();
        // Pass the activity data to the view if needed
        // dd($activityCollgeData);
        return view('employee.dailyactivities.remarks-status', compact('activityCollgeData', 'activity'))->with('success', 'Activity status updated');
    }
    public function showTransferForm($id)
    {
        $activity = DailyActivity::findOrFail($id);
        $employees = Employee::all(); // Fetch all employees

        return view('employee.Dailyactivities.transfer', compact('activity', 'employees'));
    }
}
