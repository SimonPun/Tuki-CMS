@extends('employee.layouts.userapp')

@section('title', 'Update Daily Activity')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update Daily Activity</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('dailyactivities.update', $activity->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Title</label>
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title', $activity->title) }}" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="check_in">Created At</label>
                                        <input id="check_in" type="date"
                                            class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                                            value="{{ old('check_in', $activity->check_in) }}">
                                        @error('check_in')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="checkout">Updated At</label>
                                        <input id="checkout" type="date"
                                            class="form-control @error('checkout') is-invalid @enderror" name="checkout"
                                            value="{{ old('checkout', $activity->checkout) }}">
                                        @error('checkout')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="colleagues">Colleagues</label>
                                        <select id="colleagues" name="colleagues[]" class="form-control" multiple>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ in_array($employee->id, $selectedColleagues) ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('colleagues')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="work_list">Work List</label>
                                        <textarea id="work_list" class="form-control @error('work_list') is-invalid @enderror" name="work_list">{{ old('work_list', $activity->work_list) }}</textarea>
                                        @error('work_list')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="file">Upload File (Optional)</label>
                                    <input id="file" type="file"
                                        class="form-control-file @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group text-center mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">Update Daily Activity</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
