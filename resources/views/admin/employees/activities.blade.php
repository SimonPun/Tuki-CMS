@extends('admin.layouts.app')

@section('title', 'Employee Activities')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Activities for {{ $employee->name }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                                <th>Work List</th>
                                <th>Finished Work</th>
                                <th>Remaining Work</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee->dailyActivities as $activity)
                                <tr>
                                    <td>{{ $activity->title }}</td>
                                    <td>{{ $activity->check_in ? \Carbon\Carbon::parse($activity->check_in)->format('d-m-Y H:i') : 'N/A' }}
                                    </td>
                                    <td>{{ $activity->checkout ? \Carbon\Carbon::parse($activity->checkout)->format('d-m-Y H:i') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($activity->work_status == 0)
                                            Not Started
                                        @elseif ($activity->work_status == 1)
                                            In Progress
                                        @elseif ($activity->work_status == 2)
                                            Completed
                                        @endif
                                    </td>
                                    <td>{{ $activity->work_list }}</td>
                                    <td>{{ $activity->finished_work }}</td>
                                    <td>{{ $activity->remaining_work }}</td>
                                    <td>
                                        @if ($activity->file)
                                            <a href="{{ asset('storage/' . $activity->file) }}" target="_blank"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('dailyactivities.download', $activity->id) }}"
                                                class="btn btn-success btn-sm">Download</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
