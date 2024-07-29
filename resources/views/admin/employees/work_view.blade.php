@extends('admin.layouts.app')

@section('title', 'Work list')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Work Details for {{ $employee->name }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Project Title</th>
                                        <th scope="col">Work List</th>
                                        <th scope="col">Finished Work</th>
                                        <th scope="col">Remaining Work</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $activity->title }}</td>
                                        <td>{!! $activity->work_list !!}</td>
                                        <td>{!! $activity->finished_work !!}</td>
                                        <td>{!! $activity->remaining_work !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
