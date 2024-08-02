@extends('employee.layouts.userapp')

@section('title', 'Update Work List')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update Work List</h4>
                        </div>

                        <div class="card-body p-3">
                            <form action="{{ route('dailyactivities.store.worklist') }}" method="POST">
                                @csrf

                                <div class="form-group mb-2">
                                    <label for="employee_name">Employee Name</label>
                                    <input type="text" name="employee_name" id="employee_name" class="form-control"
                                        value="{{ $employee->name }}" readonly>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="updated_work">Update Work List</label>
                                    <textarea name="updated_work" id="updated_work" class="form-control" cols="8" required></textarea>
                                </div>

                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
