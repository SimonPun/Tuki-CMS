<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicants;
use App\Mail\ApplicantReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = Applicants::all();
        return view('admin.applicants.index', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.applicants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle CV upload if provided
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $originalName = $file->getClientOriginalName();
            $destinationPath = 'cv';
            $cvPath = $file->storeAs($destinationPath, $originalName, 'public');
            $validatedData['cv'] = $originalName;
        }

        // Create the applicant record
        Applicants::create($validatedData);

        // Redirect with success message
        return redirect()->route('admin.applicants.create')->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicants::findOrFail($id);
        return view('admin.applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicants::findOrFail($id);
        return view('admin.applicants.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email,' . $id,
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Find the applicant by ID
        $applicant = Applicants::findOrFail($id);
        $applicant->update($validatedData);

        // Handle CV update if provided
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv', 'public');
            $applicant->cv = $cvPath;
        }

        // Save the applicant record
        $applicant->save();

        // Redirect with success message
        return redirect()->route('admin.applicants.edit', $applicant->id)->with('success', 'Applicant details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the applicant by ID and delete
        $applicant = Applicants::findOrFail($id);
        $applicant->delete();

        // Redirect with success message
        return redirect()->route('admin.applicants.index')->with('success', 'Applicant deleted successfully!');
    }

    /**
     * Reply to the specified applicant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        // Find the applicant by ID
        $applicant = Applicants::findOrFail($id);

        // Validate the reply input
        $request->validate([
            'reply_message' => 'required|string|max:5000',
        ]);

        try {
            // Send the reply
            Mail::to($applicant->email)->send(new ApplicantReplyMail($request->input('reply_message')));

            // Redirect with success message
            return redirect()->route('admin.applicants.index')->with('reply_message', 'Reply sent successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('admin.applicants.index')->with('error', 'Failed to send reply.');
        }
    }
}
