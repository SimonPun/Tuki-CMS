<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('admin.vacancy.index', compact('vacancies'));
    }

    public function add()
    {
        return view('admin.vacancy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'employment_type' => 'required|in:full-time,part-time',
        ]);

        Vacancy::create($request->all());

        return redirect()->route('admin.vacancy.list')->with('success', 'Vacancy created successfully.');
    }


    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('admin.vacancy.update', compact('vacancy'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'employment_type' => 'required|in:full-time,part-time',
        ]);

        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update($request->all());

        return redirect()->route('admin.vacancy.list')->with('success', 'Vacancy updated successfully.');
    }

    public function delete($id)
    {
        $vacancy = Vacancy::find($id);

        if ($vacancy) {
            $vacancy->delete();
            return redirect()->route('admin.vacancy.list')->with('success', 'Vacancy deleted successfully');
        }

        return redirect()->route('admin.vacancy.list')->with('error', 'Vacancy not found');
    }
}
