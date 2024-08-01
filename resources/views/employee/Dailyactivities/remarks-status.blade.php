@extends('employee.layouts.userapp')

@section('title', 'Daily Activity Status')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4> Activity Status

                            </h4>
                            <a href="/employee/dailyactivities" class="btn btn-primary btn-sm ">
                                <i class="bi bi-arrow-left"></i> Back To Activities List

                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Display success message if exists -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Form for submitting daily activity status -->
                            <form action="{{ route('dailyactivitiesColleauge.update', $activity->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="remarks">Task Title</label>
                                    <input id="titte" readonly name="title" class="form-control"
                                        value="{{ $activity->title }}" />
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea id="remarks" name="remarks" class="form-control" rows="3" placeholder="Enter your remarks here...">{{ $activityCollgeData[0]->remarks }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="work_status">Status</label>
                                    <select id="work_status" class="form-control @error('work_status') is-invalid @enderror"
                                        name="work_status">

                                        <option value="0"
                                            {{ old('work_status', $activityCollgeData[0]->work_status) == '0' ? 'selected' : '' }}>
                                            Not Started</option>
                                        <option value="1"
                                            {{ old('work_status', $activityCollgeData[0]->work_status) == '1' ? 'selected' : '' }}>
                                            In Progress</option>
                                        <option value="2"
                                            {{ old('work_status', $activityCollgeData[0]->work_status) == '2' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="3"
                                            {{ old('work_status', $activityCollgeData[0]->work_status) == '3' ? 'selected' : '' }}>
                                            Pending</option>

                                    </select>
                                    @error('work_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
