@extends('admin.layouts.app')

@section('title')
    List of Vacancies
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>List of Vacancies</h3>
                    </div>
                    <div class="card-body">
                        @if ($vacancies->isEmpty())
                            <p>No vacancies available.</p>
                        @else
                            <div class="table-responsive">
                                <table id="list_vacancies" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <th>Description</th>
                                            <th>Employment Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vacancies as $vacancy)
                                            <tr>
                                                <td>{{ $vacancy->id }}</td>
                                                <td>{{ $vacancy->title }}</td>
                                                <td>{{ $vacancy->subtitle }}</td>
                                                <td>{{ $vacancy->description }}</td>
                                                <td>{{ $vacancy->employment_type == 'full-time' ? 'Full-Time' : 'Part-Time' }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.vacancy.delete', $vacancy->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <a href="{{ route('admin.vacancy.edit', ['id' => $vacancy->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#list_vacancies').DataTable();
        });
    </script>
@endsection
