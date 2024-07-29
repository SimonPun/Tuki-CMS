@extends('admin.layouts.app')

@section('title')
    List of Applicants
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <!-- Notification Messages -->
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Toast Notifications -->
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
                        <div id="reply-toast" class="toast align-items-center text-bg-primary border-0" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('reply_message') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Your existing code -->
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

            // Auto-hide alert messages after a certain time
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.classList.remove('show');
                }
                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.classList.remove('show');
                }
            }, 5000); // Hide after 5 seconds

            // Show toast notification if reply message exists
            @if (session('reply_message'))
                var toastEl = document.getElementById('reply-toast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            @endif
        });
    </script>
@endsection
