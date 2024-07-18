@extends('admin.layouts.app')

@section('title', 'List of Employees')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>List of Employees</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_employee" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th> <!-- New column for Image -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle"
                                                        src="{{ asset('storage/' . $employee->image) }}"
                                                        alt="{{ $employee->name }}">
                                                </div>
                                            </td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{ route('admin.employee.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $employee->id }}">
                                                        <button type="submit" class="btn btn-danger mr-2"
                                                            onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                                    </form>
                                                    <a href="{{ route('admin.employee.edit', ['id' => $employee->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                </div>
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
            $('#list_employee').DataTable();
        });
    </script>
@endsection
