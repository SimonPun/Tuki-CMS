@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add New Team Member</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.employee.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="emp_name" class="">Name</label>
                                                <input name="name" id="emp_name" placeholder="Enter Your Name"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="emp_email" class="">Email</label>
                                                <input name="email" id="emp_email" placeholder="Enter Your Email"
                                                    type="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="emp_password" class="">Password</label>
                                                <input name="password" id="emp_password" placeholder="Enter Password"
                                                    type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="emp_position" class="">Position</label>
                                                <input name="position" id="emp_position"
                                                    placeholder="Enter Employee Position" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="emp_image" class="">Image</label>
                                                <input name="image" id="emp_image" type="file" class="form-control">
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
