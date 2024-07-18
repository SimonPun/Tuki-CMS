@extends('admin.layouts.app')

@section('title')
    List of Applicants
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">

                <div class="card">
                    <div class="card-header">
                        <h3>List of Applicants</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>CV</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $applicant->name }}</td>
                                            <td>{{ $applicant->email }}</td>
                                            <td>{{ $applicant->subject }}</td>
                                            <td>
                                                @if ($applicant->cv)
                                                    <a href="{{ asset('storage/' . $applicant->cv) }}" download
                                                        class="btn btn-success btn-sm">Download CV</a>
                                                @else
                                                    No CV uploaded
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.applicants.destroy', ['id' => $applicant->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this applicant?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No applicants found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
