@extends('admin.layouts.app')

@section('title', 'Employee Activities')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $employee->name }}'s Activities</h4>
                    <a href="{{ route('admin.employee.list') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to Employee List
                    </a>
                </div>
                <div class="card-body">
                    @if ($employee->dailyActivities->isEmpty() && $employee->mentionedActivities->isEmpty())
                        <div class="alert alert-info" role="alert">
                            No activities found.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Status</th>
                                        <th>Colleagues</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee->dailyActivities as $activity)
                                        <tr>
                                            <td>{{ $activity->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->check_in)->format('M d, Y h:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($activity->checkout)->format('M d, Y h:i A') }}
                                            </td>
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
                                            <td>
                                                @forelse ($activity->colleagues as $colleague)
                                                    <div class="badge bg-primary text-white mb-1"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;">
                                                        {{ $colleague->name }}
                                                    </div>
                                                @empty
                                                    <div class="text-muted">No colleagues</div>
                                                @endforelse
                                            </td>
                                            <td>
                                                @if ($activity->file)
                                                    <a href="{{ asset('storage/' . $activity->file) }}"
                                                        class="btn btn-outline-primary btn-sm" download>
                                                        <i class="bi bi-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.employee.work_view', ['id' => $activity->id]) }}"
                                                    class="btn btn-primary btn-sm">View Work</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($employee->mentionedActivities as $activity)
                                        <tr>
                                            <td>{{ $activity->title }} (Mentioned)</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->check_in)->format('M d, Y h:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($activity->checkout)->format('M d, Y h:i A') }}
                                            </td>
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
                                            <td>
                                                @forelse ($activity->colleagues as $colleague)
                                                    <div class="badge bg-primary text-white mb-1"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;">
                                                        {{ $colleague->name }}
                                                    </div>
                                                @empty
                                                    <div class="text-muted">No colleagues</div>
                                                @endforelse
                                            </td>
                                            <td>
                                                @if ($activity->file)
                                                    <a href="{{ asset('storage/' . $activity->file) }}"
                                                        class="btn btn-outline-primary btn-sm" download>
                                                        <i class="bi bi-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.employee.work_view', ['id' => $activity->id]) }}"
                                                    class="btn btn-primary btn-sm">View Work</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
