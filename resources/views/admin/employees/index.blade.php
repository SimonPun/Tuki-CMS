@extends('admin.layouts.app')

@section('title', 'List of Employees')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">List of Employees</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_employee" class="table table-hover table-striped table-bordered"
                                style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Activities</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>
                                                <img width="50" class="rounded-circle border"
                                                    src="{{ $employee->image ? asset('storage/' . $employee->image) : asset('assets/images/avatar.png') }}"
                                                    alt="{{ $employee->name }}">
                                            </td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>
                                                <a href="{{ route('admin.employees.activities', ['id' => $employee->id]) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View Activities
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <form action="{{ route('admin.employee.delete', $employee->id) }}"
                                                        method="POST" class="mr-2">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirmDeletion()">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.employee.edit', ['id' => $employee->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-..."
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#list_employee').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        function confirmDeletion() {
            return confirm('Are you sure you want to delete this employee?');
        }
    </script>
@endsection
