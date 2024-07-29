@extends('employee.layouts.userapp')

@section('title', 'Add Daily Activity')

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
                            <h4 class="mb-0">Add Daily Activity</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('dailyactivities.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Title</label>
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title') }}" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="check_in">Check In</label>
                                        <input id="check_in" type="date"
                                            class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                                            value="{{ old('check_in') }}">
                                        @error('check_in')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="checkout">Check Out</label>
                                        <input id="checkout" type="date"
                                            class="form-control @error('checkout') is-invalid @enderror" name="checkout"
                                            value="{{ old('checkout') }}">
                                        @error('checkout')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="work_status">Work Status</label>
                                        <select id="work_status"
                                            class="form-control @error('work_status') is-invalid @enderror"
                                            name="work_status">
                                            <option value="0" {{ old('work_status') == '0' ? 'selected' : '' }}>Not
                                                Started</option>
                                            <option value="1" {{ old('work_status') == '1' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="2" {{ old('work_status') == '2' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="3" {{ old('work_status') == '3 ' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                        @error('work_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="colleagues">Colleagues</label>
                                        <select id="colleagues" name="colleagues[]" class="form-control" multiple>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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
                                    <div class="form-group col-md-6">
                                        <label for="work_list">Work List</label>
                                        <textarea id="work_list" class="form-control @error('work_list') is-invalid @enderror" name="work_list">{{ old('work_list') }}</textarea>
                                        @error('work_list')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="finished_work">Finished Work</label>
                                        <textarea id="finished_work" class="form-control @error('finished_work') is-invalid @enderror" name="finished_work">{{ old('finished_work') }}</textarea>
                                        @error('finished_work')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="remaining_work">Remaining Work</label>
                                        <textarea id="remaining_work" class="form-control @error('remaining_work') is-invalid @enderror" name="remaining_work">{{ old('remaining_work') }}</textarea>
                                        @error('remaining_work')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group text-center mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">Add Daily Activity</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
