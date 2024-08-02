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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dailyactivities.transfer', $activity->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="employee">Transfer to Employee</label>
                            <select id="colleagues" name="colleagues[]" class="form-control" multiple>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="note">Rason For Transfer</label>
                            <textarea id="note" name="remarks" class="form-control" rows="4" placeholder="Enter a reason to transfer"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
