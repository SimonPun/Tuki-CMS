@extends('admin.layouts.app')

@section('title')
    Create Task
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Task Create</h5>
                            </div>
                            <div class="card-body">
                                <form class="" id="create_task">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="employee">List of Employee</label>
                                                <select name="employee" id="employee" class="form-control">
                                                    <option value="">Select Employee</option>
                                                    @forelse ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                    @empty
                                                        <option value="">Employee list not found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input name="title" id="title" placeholder="Enter Your Title"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content">Content/Description</label>
                                                <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Publish Date</label>
                                                <input name="date" id="date" type="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Create</button>
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
        $("#create_task").submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.task.create') }}',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.success == true) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
    </script>
@endsection
