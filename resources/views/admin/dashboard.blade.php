<!-- resources/views/admin/employees/index.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h5 class="mb-0">Team Members</h5>
                            <a href="{{ route('admin.employee.add') }}" class="btn btn-light btn-sm">
                                <i class="bi bi-plus-circle"></i> Add Team Members
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img width="40" class="rounded-circle me-3"
                                                            src="{{ asset('storage/' . $item->image) }}"
                                                            alt="{{ $item->name }}">
                                                        <div>
                                                            <div class="fw-bold">{{ $item->name }}</div>
                                                            <div class="text-muted">{{ $item->position }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.employee.show', ['id' => $item->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="bi bi-info-circle"></i> Details
                                                    </a>
                                                    <a href="{{ route('admin.employees.activities', ['id' => $item->id]) }}"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-calendar-event"></i> Activities
                                                    </a>
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
    </div>
@endsection
