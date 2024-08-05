@extends('employee.layouts.userapp')

@section('title', 'Daily Activity Details')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-white text-black">
                            <h4 class="mb-0">Daily Activity Details</h4>

                        </div>

                        <div class="card-bodys p-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($worklist as $item)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>
                                                {{ $i }}. {{ $item->Updated_Work }}
                                                <a href="{{ route('dailyactivitieslist.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm float-right">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>

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
