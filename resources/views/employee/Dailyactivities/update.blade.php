@extends('employee.layouts.userapp')

@section('title', 'Update Daily Activity')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">Update Daily Activity</div>
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

                                <div class="row">
                                    <!-- Title Field -->
                                    <div class="col-md-6 form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter activity title" value="{{ old('title', $activity->title) }}">
                                    </div>

                                    <!-- Check In Field -->
                                    <div class="col-md-6 form-group">
                                        <label for="check_in" class="form-label">Check In</label>
                                        <input type="datetime-local" class="form-control" id="check_in" name="check_in"
                                            value="{{ old('check_in', date('Y-m-d\TH:i', strtotime($activity->check_in))) }}">
                                    </div>

                                    <!-- Check Out Field -->
                                    <div class="col-md-6 form-group">
                                        <label for="checkout" class="form-label">Check Out</label>
                                        <input type="datetime-local" class="form-control" id="checkout" name="checkout"
                                            value="{{ old('checkout', date('Y-m-d\TH:i', strtotime($activity->checkout))) }}">
                                    </div>

                                    <!-- Work Status Field -->
                                    <div class="col-md-6 form-group">
                                        <label for="work_status" class="form-label">Work Status</label>
                                        <select class="form-control" id="work_status" name="work_status">
                                            <option value="0"
                                                {{ old('work_status', $activity->work_status) == 0 ? 'selected' : '' }}>Not
                                                Started</option>
                                            <option value="1"
                                                {{ old('work_status', $activity->work_status) == 1 ? 'selected' : '' }}>
                                                In Progress</option>
                                            <option value="2"
                                                {{ old('work_status', $activity->work_status) == 2 ? 'selected' : '' }}>
                                                Finished</option>
                                            <option value="3"
                                                {{ old('work_status', $activity->work_status) == 3 ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                    </div>

                                    <!-- Work List Field -->
                                    <div class="col-md-12 form-group">
                                        <label for="work_list" class="form-label">Work List</label>
                                        <textarea class="form-control" id="work_list" name="work_list" rows="4" placeholder="Describe the work list">{{ old('work_list', $activity->work_list) }}</textarea>
                                    </div>

                                    <!-- Finished Work Field -->
                                    <div class="col-md-12 form-group">
                                        <label for="finished_work" class="form-label">Finished Work</label>
                                        <textarea class="form-control" id="finished_work" name="finished_work" rows="4"
                                            placeholder="Describe the finished work">{{ old('finished_work', $activity->finished_work) }}</textarea>
                                    </div>

                                    <!-- Remaining Work Field -->
                                    <div class="col-md-12 form-group">
                                        <label for="remaining_work" class="form-label">Remaining Work</label>
                                        <textarea class="form-control" id="remaining_work" name="remaining_work" rows="4"
                                            placeholder="Describe the remaining work">{{ old('remaining_work', $activity->remaining_work) }}</textarea>
                                    </div>

                                    <!-- Colleagues Field -->
                                    <div class="col-md-12 form-group">
                                        <label for="colleagues" class="form-label">Colleagues</label>
                                        <select class="form-control" id="colleagues" name="colleagues[]" multiple>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ in_array($employee->id, old('colleagues', $activity->colleagues->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- File Upload Field -->
                                    <div class="col-md-12 form-group">
                                        <label for="file" class="form-label">File (Optional)</label>
                                        <input type="file" class="form-control-file" id="file" name="file">
                                    </div>

                                    <!-- Form Buttons -->
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Update Activity</button>
                                        <a href="{{ route('dailyactivities.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
