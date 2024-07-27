@extends('employee.layouts.userapp')

@section('title', 'Daily Activities List')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daily Activities List</h4>
                </div>

                <div class="card-body">
                    @if ($activities->isEmpty())
                        <p class="text-center text-muted">No activities found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Title</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Status</th>
                                        <th>Colleagues</th>
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
                                                    <span class="badge badge-secondary">Not Started</span>
                                                @elseif ($activity->work_status == 1)
                                                    <span class="badge badge-warning">In Progress</span>
                                                @elseif ($activity->work_status == 2)
                                                    <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @forelse ($activity->colleagues as $colleague)
                                                    <div class="badge badge-info"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;">
                                                        {{ $colleague->name }}
                                                    </div>
                                                @empty
                                                    <div class="text-muted">No colleagues</div>
                                                @endforelse
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('dailyactivities.edit', $activity->id) }}"
                                                        class="btn btn-sm btn-primary mr-2">Edit</a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('dailyactivities.destroy', $activity->id) }}"
                                                        method="POST" class="delete-form" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
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

@section('footer')
    <script>
        $(document).ready(function() {
            // Optional: You can initialize any additional JavaScript here
        });

        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();

            const form = this;
            const isConfirmed = confirm('Are you sure you want to delete this activity?');

            if (isConfirmed) {
                form.submit(); // Proceed with form submission if confirmed
            }
        });
    </script>
@endsection
