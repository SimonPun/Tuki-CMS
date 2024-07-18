@extends('admin.layouts.app')

@section('title')
    Update Task
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Task Update</h5>
                                <form class="" id="update_task">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <input name="id" id="id" value="{{ $task->id }}" type="hidden" class="form-control">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="employee" class="">List of Employee</label>
                                                <select name="employee" id="employee" class="form-control">
                                                    <option value="">Select Employee</option>
                                                    @forelse ($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ $employee->id == $task->emp_id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @empty
                                                        <option value="">Employee list not found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="title" class="">Title</label>
                                                <input name="title" id="title" value="{{ $task->title }}" placeholder="Enter Your Title" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="content" class="">Content/Description</label>
                                                <textarea name="content" id="content" class="form-control" cols="30" rows="5">{{ $task->content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="date" class="">Publish Date</label>
                                                <input name="date" id="date" value="{{ $task->date }}" type="date" class="form-control">
                                            </div>
                                            <div class="position-relative form-group">
                                                <label for="status" class="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Update</button>
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
                    if (data.success == true) {
                        alert(data.message)
                    } else {
                        alert(data.message)
                    }
                }
            })

        })
    </script>
@endsection
