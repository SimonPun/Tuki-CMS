@extends('admin.layouts.app')

@section('title')
    Employee Profile
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container mt-5">
                <div class="card border-0 shadow-lg rounded-lg">
                    <div class="card-header bg-gradient-primary text-black rounded-top-lg">
                        <h3 class="mb-0">Employee Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Employee Image and Basic Info -->
                            <div class="col-md-4 text-center">
                                <img class="img-fluid border border-light rounded-circle shadow-lg"
                                    src="{{ $employee->image ? asset('storage/' . $employee->image) : asset('assets/images/avatar.png') }}"
                                    alt="Employee Image" style="width: 180px; height: 180px;">
                                <h4 class="mt-3 mb-1 font-weight-bold">{{ $employee->name }}</h4>
                                <p class="text-muted mb-4">{{ $employee->position }}</p>
                            </div>
                            <!-- Employee Details Table -->
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">Name</th>
                                            <td>{{ $employee->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">Email</th>
                                            <td>{{ $employee->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">City</th>
                                            <td>{{ $employee->city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">Position</th>
                                            <td>{{ $employee->position }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">Facebook Profile</th>
                                            <td>
                                                @if ($employee->facebook)
                                                    <a href="{{ $employee->facebook }}" target="_blank"
                                                        class="text-primary">{{ $employee->facebook }}</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="font-weight-bold text-secondary">LinkedIn Profile</th>
                                            <td>
                                                @if ($employee->linkedin)
                                                    <a href="{{ $employee->linkedin }}" target="_blank"
                                                        class="text-primary">{{ $employee->linkedin }}</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('admin.employee.edit', $employee->id) }}"
                                    class="btn btn-primary btn-lg mt-4 transition-transform hover:scale-105">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
