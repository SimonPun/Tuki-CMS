@extends('employee.layouts.userapp')

@section('title', 'Daily Activity Status')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Colleagues' Work Status Of
                                @if ($activities->isNotEmpty())
                                    {{ $activities->first()->title }}
                                @else
                                    No Activities Available
                                @endif
                            </h3>
                            <a href="/employee/dailyactivities" class="btn btn-primary btn-sm ">
                                <i class="bi bi-arrow-left"></i> Back to Activity List
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($activities->isEmpty())
                                <p>No colleagues associated with this activity.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Work Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td>{{ $activity->employee_name }}</td>
                                                <td>
                                                    @if ($activity->work_status == 0)
                                                        <span class="badge bg-secondary text-white">Not Started</span>
                                                    @elseif ($activity->work_status == 1)
                                                        <span class="badge bg-warning text-dark">In Progress</span>
                                                    @elseif ($activity->work_status == 2)
                                                        <span class="badge bg-success text-white">Completed</span>
                                                    @elseif ($activity->work_status == 3)
                                                        <span class="badge bg-danger text-white">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
