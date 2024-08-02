@extends('employee.layouts.userapp')

@section('title', 'Update Daily Activity')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Update Daily Activity</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
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

                                <div class="form-row">
                                    <!-- Title Field -->
                                    <div class="form-group col-md-6">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter activity title" value="{{ old('title', $activity->title) }}">
                                    </div>

                                    <!-- Check In Field -->
                                    <div class="form-group col-md-6">
                                        <label for="check_in" class="form-label">Created At</label>
                                        <input type="datetime-local" class="form-control" id="check_in" name="check_in"
                                            value="{{ old('check_in', date('Y-m-d\TH:i', strtotime($activity->check_in))) }}">
                                    </div>

                                    <!-- Check Out Field -->
                                    <div class="form-group col-md-6">
                                        <label for="checkout" class="form-label">Updated At</label>
                                        <input type="datetime-local" class="form-control" id="checkout" name="checkout"
                                            value="{{ old('checkout', date('Y-m-d\TH:i', strtotime($activity->checkout))) }}">
                                    </div>



                                    <!-- Work List Field -->
                                    <div class="form-group col-md-12">
                                        <label for="work_list" class="form-label">Work List</label>
                                        <textarea class="form-control" id="work_list" name="work_list" rows="4" placeholder="Describe the work list">{{ old('work_list', $activity->work_list) }}</textarea>
                                    </div>

                                    <!-- Colleagues Field -->
                                    <div class="form-group col-md-12">
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
                                    <div class="form-group col-md-12">
                                        <label for="file" class="form-label">File (Optional)</label>
                                        <input type="file" class="form-control-file" id="file" name="file">
                                    </div>

                                    <!-- Form Buttons -->
                                    <div class="form-group col-md-12 d-flex justify-content-between">
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
