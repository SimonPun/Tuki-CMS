@extends('admin.layouts.app')

@section('title')
    Update Task
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header bg-primary" style="color: white;">
                                <h5 class="card-title mb-0">Update Task</h5>
                            </div>

                            <div class="card-body">
                                <form id="update_task">
                                    @csrf
                                    <input name="id" id="id" value="{{ $task->id }}" type="hidden">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="employee">List of Employees</label>
                                                <select name="employee" id="employee" class="form-control">
                                                    <option value="">Select Employee</option>
                                                    @forelse ($employees as $employee)
                                                        <option value="{{ $employee->id }}"
                                                            {{ $employee->id == $task->emp_id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @empty
                                                        <option value="">No employees found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input name="title" id="title" value="{{ $task->title }}"
                                                    placeholder="Enter Task Title" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content">Content/Description</label>
                                                <textarea name="content" id="content" class="form-control" rows="5">{{ $task->content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Publish Date</label>
                                                <input name="date" id="date" value="{{ $task->date }}"
                                                    type="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $("#update_task").submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.task.update') }}",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = "{{ route('admin.task.list') }}";
                    } else {
                        alert(data.message);
                    }
                },
                error: (xhr, status, error) => {
                    console.error(xhr.responseText);
                    alert('An error occurred while processing your request.');
                }
            });
        });
    </script>
@endsection
