@extends('admin.layouts.app')

@section('title')
    Update Employee
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Edit Team Member's Details</h5>
                                <form class="" id="update_emp" method="POST"
                                    action="{{ route('admin.employee.update', ['id' => $employee->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_name">Name</label>
                                                <input name="name" value="{{ $employee->name }}" id="emp_name"
                                                    placeholder="Enter Your Name" type="text" class="form-control">
                                                <input name="id" value="{{ $employee->id }}" id="id"
                                                    type="hidden" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_email">Email</label>
                                                <input name="email" value="{{ $employee->email }}" id="emp_email"
                                                    placeholder="Enter Your Email" type="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_position">Position</label>
                                                <input name="position" value="{{ $employee->position }}" id="emp_position"
                                                    placeholder="Enter Position" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_start_date">Start Date</label>
                                                <input name="start_date" value="{{ $employee->start_date }}"
                                                    id="emp_start_date" placeholder="Enter Start Date" type="date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_phone">Phone</label>
                                                <input name="phone" value="{{ $employee->phone }}" id="emp_phone"
                                                    placeholder="Enter Your Phone" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_city">City</label>
                                                <input name="city" value="{{ $employee->city }}" id="emp_city"
                                                    placeholder="Enter Your City" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_linkedin">LinkedIn</label>
                                                <input name="linkedin" value="{{ $employee->linkedin }}" id="emp_linkedin"
                                                    placeholder="Enter LinkedIn URL" type="url" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_facebook">Facebook</label>
                                                <input name="facebook" value="{{ $employee->facebook }}" id="emp_facebook"
                                                    placeholder="Enter Facebook URL" type="url" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="emp_image">Image</label>
                                                <input name="image" id="emp_image" type="file" class="form-control">
                                                <img src="{{ asset('storage') }}/{{ $employee->image }}" width="60"
                                                    alt="">
                                                <input name="old_image" id="emp_image" type="hidden"
                                                    value="{{ $employee->image }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
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
        $("#update_emp").submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.employee.update') }}',
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
