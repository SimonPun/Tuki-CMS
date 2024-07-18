@extends('employee.layouts.userapp')

@section('title')
    Daily Activities List
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card">
                <div class="card-header">Daily Activities List</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>{{ $activity->title }}</td>
                                    <td>{{ $activity->check_in }}</td>
                                    <td>{{ $activity->checkout }}</td>
                                    <td>
                                        @if ($activity->work_status == 0)
                                            Not Started
                                        @elseif ($activity->work_status == 1)
                                            In Progress
                                        @elseif ($activity->work_status == 2)
                                            Completed
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('dailyactivities.update', $activity->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Edit</button>
                                        </form>

                                        <!-- Example of delete button -->
                                        <form action="{{ route('dailyactivities.destroy', $activity->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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
