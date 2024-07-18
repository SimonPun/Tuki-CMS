@extends('admin.layouts.app')

@section('title')
    Add New Vacancy
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Add New Vacancy</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.vacancy.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="employment_type">Employment Type</label>
                                <select class="form-control" id="employment_type" name="employment_type" required>
                                    <option value="full-time">Full-Time</option>
                                    <option value="part-time">Part-Time</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Vacancy</button>
                            <a href="{{ route('admin.vacancy.list') }}" class="btn btn-secondary">Cancel</a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
