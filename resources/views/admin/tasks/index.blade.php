@extends('admin.layouts.app')

@section('title')
    List of Tasks
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">List of Tasks</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_tasks" class="table table-striped" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Project Title</th>
                                        <th>Content</th>
                                        <th>Publish Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td>{{ $task->employee->name }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->content }}</td>
                                            <td>{{ $task->date }}</td>
                                            <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" id="delete-task"
                                                    data-id="{{ $task->id }}">Delete</button>
                                                <a href="{{ route('admin.task.edit', ['id' => $task->id]) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#list_tasks').DataTable();
        });

        $(document).on('click', '#delete-task', function(e) {
            e.preventDefault();

            const id = $(this).data('id');
            const isConfirmed = confirm('Are you sure you want to delete this task?');

            if (isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.task.delete') }}",
                    data: {
                        id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: (data) => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = "{{ route('admin.task.list') }}";
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });
    </script>
@endsection
