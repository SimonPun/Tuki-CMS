@extends('employee.layouts.userapp')

@section('title', 'Update Daily Activity')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Update Daily Activity</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('dailyactivities.update', $activity->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $activity->title) }}">
                                </div>

                                <div class="form-group">
                                    <label for="check_in">Check In</label>
                                    <input type="datetime-local" class="form-control" id="check_in" name="check_in"
                                        value="{{ old('check_in', date('Y-m-d\TH:i', strtotime($activity->check_in))) }}">
                                </div>

                                <div class="form-group">
                                    <label for="checkout">Check Out</label>
                                    <input type="datetime-local" class="form-control" id="checkout" name="checkout"
                                        value="{{ old('checkout', date('Y-m-d\TH:i', strtotime($activity->checkout))) }}">
                                </div>

                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>

                                <div class="form-group">
                                    <label for="work_status">Work Status</label>
                                    <select class="form-control" id="work_status" name="work_status">
                                        <option value="1"
                                            {{ old('work_status', $activity->work_status) == 1 ? 'selected' : '' }}>Work In
                                            Progress</option>
                                        <option value="2"
                                            {{ old('work_status', $activity->work_status) == 2 ? 'selected' : '' }}>Finished
                                        </option>
                                        <option value="3"
                                            {{ old('work_status', $activity->work_status) == 3 ? 'selected' : '' }}>Pending
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="work_list">Work List</label>
                                    <textarea class="form-control" id="work_list" name="work_list">{{ old('work_list', $activity->work_list) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="finished_work">Finished Work</label>
                                    <textarea class="form-control" id="finished_work" name="finished_work">{{ old('finished_work', $activity->finished_work) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="remaining_work">Remaining Work</label>
                                    <textarea class="form-control" id="remaining_work" name="remaining_work">{{ old('remaining_work', $activity->remaining_work) }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Activity</button>
                                <a href="{{ route('dailyactivities.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
