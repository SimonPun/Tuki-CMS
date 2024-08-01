@extends('employee.layouts.userapp')

@section('title', 'Transfer Task')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card shadow-sm">
                <div class="card-header bg-white text-black">
                    <h4 class="mb-0">Transfer Task</h4>
                    <a href="/employee/dailyactivities" class="btn btn-primary btn-sm ">
                        <i class="bi bi-arrow-left"></i> Back To Activities List

                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('dailyactivities.transfer', $activity->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="employee">Transfer to Employee</label>
                            <select id="employee" name="employee_id" class="form-control">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="note">Rason For Transfer</label>
                            <textarea id="note" name="note" class="form-control" rows="4" placeholder="Enter a reason for transfer"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
