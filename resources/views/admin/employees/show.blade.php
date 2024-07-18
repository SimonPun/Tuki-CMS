@extends('admin.layouts.app')

@section('title')
    Employee Profile
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container mt-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Employee Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img class="img-fluid border border-primary rounded"
                                    src="{{ asset('storage/' . $employee->image) }}" alt="Employee Image"
                                    style="width: 200px; height: auto;">
                                <h5 class="mt-3">{{ $employee->name }}</h5>
                                <p class="text-muted">{{ $employee->position }}</p>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->email }}</td>
                                    </tr>




                                </table>
                                <a href="{{ route('admin.employee.edit', $employee->id) }}"
                                    class="btn btn-primary btn-lg">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
