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
                    @if (count($activities) === 0)

                        <p class="text-center text-muted">No activities found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Colleagues</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activityData)
                                        <tr>
                                            <td>{{ $activityData['activity']->title }}</td>
                                            <td>{{ $activityData['activity']->check_in }}</td>
                                            <td>{{ $activityData['activity']->checkout }}</td>
                                            <td>
                                                @foreach ($activityData['colleagues'] as $colleague)
                                                    <div class="badge bg-primary text-white mb-1"
                                                        style="display: block; margin-bottom: 5px; font-size: 0.8rem; padding: 0.2em 0.4em; max-width: 150px;">
                                                        {{ $colleague->employee_name }}
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <!-- Dropdown Button for Actions -->
                                                    <div class="dropdown mr-2">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('dailyactivities.status', ['id' => $activityData['activity']->id]) }}">
                                                                View Status
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('/employee/dailyactivities/' . $activityData['activity']->id . '/action') }}">
                                                                Update Status
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('dailyactivities.transfer', $activityData['activity']->id) }}">
                                                                Transfer Task
                                                            </a>
                                                            <a class="dropdown-item" href="">
                                                                Canecl Task
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('dailyactivities.show', $activityData['activity']->id) }}">
                                                                Add Work List
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('dailyactivities.edit', $activityData['activity']->id) }}">
                                                                Edit Task
                                                            </a>
                                                            <form
                                                                action="{{ route('dailyactivities.destroy', $activityData['activity']->id) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    style="color: #dc3545;">Delete Task</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            <div class="pagination-wrapper">
                                {{ $pagination->links() }}
                            </div>
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
            $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips

            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();

                const form = this;
                const isConfirmed = confirm('Are you sure you want to delete this activity?');

                if (isConfirmed) {
                    form.submit(); // Proceed with form submission if confirmed
                }
            });
        });
    </script>
@endsection
