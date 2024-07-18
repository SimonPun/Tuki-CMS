<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicants;
use Illuminate\Http\Request;



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

            // Define the path where the file should be stored
            $destinationPath = 'cv';

            // Store the file with the original name in the public disk
            $cvPath = $file->storeAs($destinationPath, $originalName, 'public');

            // Save the original file name in the validated data
            $validatedData['cv'] = $originalName;
        }

        // Create the applicant record
        $applicant = Applicants::create($validatedData);

        // Redirect to a success page or return a response
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
    // public function update(Request $request, $id)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:applicants,email,' . $id,
    //         'subject' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    //     ]);

    //     // Retrieve the applicant record
    //     $applicant = Applicants::findOrFail($id);

    //     // Update applicant details
    //     $applicant->name = $validatedData['name'];
    //     $applicant->email = $validatedData['email'];
    //     $applicant->subject = $validatedData['subject'];
    //     $applicant->description = $validatedData['description'];

    //     // Handle CV update if provided
    //     if ($request->hasFile('cv')) {
    //         $cvPath = $request->file('cv')->store('cv', 'public');
    //         $applicant->cv = $cvPath;
    //     }

    //     // Save the applicant record
    //     $applicant->save();

    //     // Redirect to a success page or return a response
    //     return redirect()->route('admin.applicants.edit', $applicant->id)->with('success', 'Applicant details updated successfully!');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $applicant = Applicants::findOrFail($id);
        $applicant->delete();
        return redirect()->route('admin.applicants.index')->with('success', 'Applicant deleted successfully!');
    }
}
