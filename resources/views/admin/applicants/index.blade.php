@extends('admin.layouts.app')

@section('title')
    List of Applicants
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="card">
                    <div class="card-header bg-primary text-white">
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
                                        <th>Reply</th>
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
                                                    <a href="{{ Storage::url('cv/' . $applicant->cv) }}" target="_blank"
                                                        class="btn btn-info btn-sm">View CV</a>
                                                @else
                                                    No CV uploaded
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.applicants.destroy', $applicant->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this applicant?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <button id="reply-btn-{{ $applicant->id }}" class="btn btn-primary btn-sm">
                                                    Send Reply
                                                </button>
                                                <div id="reply-form-{{ $applicant->id }}" class="reply-form mt-3"
                                                    style="display:none;">
                                                    <form action="{{ route('admin.applicants.reply', $applicant->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="reply_message" class="form-control" placeholder="Write your reply here..." required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-sm">Send</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No applicants found.</td>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($applicants as $applicant)
                document.getElementById('reply-btn-{{ $applicant->id }}').addEventListener('click', function() {
                    var replyForm = document.getElementById('reply-form-{{ $applicant->id }}');
                    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                });
            @endforeach
        });
    </script>
@endsection
