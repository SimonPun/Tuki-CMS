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
                    @php
                        $dailyActivities = $employee->dailyActivities ?? collect();
                        $mentionedActivities = $mentionedActivities ?? collect();
                    @endphp

                    @if ($dailyActivities->isEmpty() && $mentionedActivities->isEmpty())
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
                                        <th>Creator</th> <!-- New Column for Creator -->
                                        <th>File</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dailyActivities as $activity)
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
                                                @if ($activity->creator)
                                                    <div class="badge bg-success text-white mb-1"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Created By: {{ $activity->creator->name }}">
                                                        {{ $activity->creator->name }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">No creator</div>
                                                @endif
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
                                            <td>{{ $activity->employee->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.employee.work_view', ['id' => $activity->id]) }}"
                                                    class="btn btn-primary btn-sm">View Work</a>
                                                <!-- Modal Trigger Button -->
                                                @if ($activity->creator)
                                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#creatorModal-{{ $activity->id }}">
                                                        View Creator
                                                    </a>
                                                @endif
                                                <!-- Creator Details Modal -->
                                                <div class="modal fade" id="creatorModal-{{ $activity->id }}"
                                                    tabindex="-1" aria-labelledby="creatorModalLabel-{{ $activity->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="creatorModalLabel-{{ $activity->id }}">Creator
                                                                    Details</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($activity->creator)
                                                                    <p>Name: {{ $activity->creator->name }}</p>
                                                                    <p>Email: {{ $activity->creator->email }}</p>
                                                                    <p>Position: {{ $activity->creator->position }}</p>
                                                                @else
                                                                    <p>No creator information available.</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Display mentioned activities --}}
                                    @foreach ($mentionedActivities as $activity)
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
                                                @if ($activity->creator)
                                                    <div class="badge bg-success text-white mb-1"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Created By: {{ $activity->creator->name }}">
                                                        {{ $activity->creator->name }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">No creator</div>
                                                @endif
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
                                            <td>{{ $activity->employee->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.employee.work_view', ['id' => $activity->id]) }}"
                                                    class="btn btn-primary btn-sm">View Work</a>
                                                <!-- Modal Trigger Button -->
                                                @if ($activity->creator)
                                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#creatorModal-{{ $activity->id }}">
                                                        View Creator
                                                    </a>
                                                @endif
                                                <!-- Creator Details Modal -->
                                                <div class="modal fade" id="creatorModal-{{ $activity->id }}"
                                                    tabindex="-1" aria-labelledby="creatorModalLabel-{{ $activity->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="creatorModalLabel-{{ $activity->id }}">Creator
                                                                    Details</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($activity->creator)
                                                                    <p>Name: {{ $activity->creator->name }}</p>
                                                                    <p>Email: {{ $activity->creator->email }}</p>
                                                                    <p>Position: {{ $activity->creator->position }}</p>
                                                                @else
                                                                    <p>No creator information available.</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
