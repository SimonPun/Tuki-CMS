@extends('admin.layouts.app')

@section('title')
    Update Vacancy
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Vacancy Update</h5>
                                <form action="{{ route('admin.vacancy.update', $vacancy->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="id" value="{{ $vacancy->id }}"
                                        class="form-control">

                                    <div class="position-relative form-group">
                                        <label for="title" class="">Title</label>
                                        <input name="title" id="title" value="{{ $vacancy->title }}"
                                            placeholder="Enter Your Title" type="text" class="form-control" required>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="subtitle" class="">Subtitle</label>
                                        <input name="subtitle" id="subtitle" value="{{ $vacancy->subtitle }}"
                                            placeholder="Enter Your Subtitle" type="text" class="form-control" required>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="description" class="">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="5" required>{{ $vacancy->description }}</textarea>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="employment_type" class="">Employment Type</label>
                                        <select name="employment_type" id="employment_type" class="form-control" required>
                                            <option value="full-time"
                                                {{ $vacancy->employment_type == 'full-time' ? 'selected' : '' }}>Full-Time
                                            </option>
                                            <option value="part-time"
                                                {{ $vacancy->employment_type == 'part-time' ? 'selected' : '' }}>Part-Time
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit" class="mt-1 btn btn-primary">Update</button>
                                    <a href="{{ route('admin.vacancy.list') }}" class="btn btn-secondary mt-1">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
