@extends('employee.layouts.userapp')

@section('title')
    Employee Dashboard
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Your Activities
                            <div class="btn-actions-pane-right">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Title</th>
                                        <th>check_in</th>
                                        <th>checkout</th>
                                        <th>work_status</th>

                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
