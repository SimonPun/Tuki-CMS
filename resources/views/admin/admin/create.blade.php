@extends('admin.layouts.app')

@section('title')
    Admin
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title">Admin Create</h5>
                            </div>
                            <div class="card-body">
                                <form class="" id="create_admin">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <div class="position-relative form-group">
                                        <label for="admin_name" class="">Name</label>
                                        <input name="name" id="admin_name" placeholder="Enter Admin Name" type="text"
                                            class="form-control">
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="admin_email" class="">Email</label>
                                        <input name="email" id="admin_email" placeholder="Enter Admin Email"
                                            type="email" class="form-control">
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="admin_phone" class="">Phone</label>
                                        <input name="phone" id="admin_phone" placeholder="Enter Admin Phone"
                                            type="text" class="form-control">
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="admin_password" class="">Password</label>
                                        <input name="password" id="admin_password" placeholder="Enter Admin Password"
                                            type="password" class="form-control">
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $("#create_admin").submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.admin.store') }}',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.success == true) {
                        alert(data.message)
                    } else {
                        alert(data.message)
                    }
                }
            })

        })
    </script>
@endsection
