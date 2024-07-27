@extends('employee.layouts.userapp')

@section('title', 'Account Settings')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container mt-5">
                <div class="card border-0 shadow-lg rounded-lg mb-5" style="max-width: 700px; margin: auto;">
                    <div class="card-header bg-gradient-primary text-black rounded-top-lg text-center">
                        <h3 class="mb-0">Account Settings</h3>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row mb-4">
                            <!-- Profile Image Section -->
                            <div class="col-md-12 text-center">
                                <img class="img-fluid rounded-circle border border-light shadow-sm"
                                    src="{{ asset('storage/' . auth('employee')->user()->image) }}" alt="User Image"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>

                        <form method="POST" action="{{ route('employee.auth.accountsettings.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Name Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', auth('employee')->user()->name) }}" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', auth('employee')->user()->email) }}" required
                                        autocomplete="email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- City Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">{{ __('City') }}</label>
                                    <input id="city" type="text"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        value="{{ old('city', auth('employee')->user()->city) }}" autocomplete="city">

                                    @error('city')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- LinkedIn Profile Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label">{{ __('LinkedIn Profile') }}</label>
                                    <input id="linkedin" type="text"
                                        class="form-control @error('linkedin') is-invalid @enderror" name="linkedin"
                                        value="{{ old('linkedin', auth('employee')->user()->linkedin) }}"
                                        autocomplete="linkedin">

                                    @error('linkedin')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>

                                <!-- Facebook Profile Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="facebook" class="form-label">{{ __('Facebook Profile') }}</label>
                                    <input id="facebook" type="text"
                                        class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                                        value="{{ old('facebook', auth('employee')->user()->facebook) }}"
                                        autocomplete="facebook">

                                    @error('facebook')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Profile Image Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">{{ __('Profile Image') }}</label>
                                    <input id="image" type="file"
                                        class="form-control-file @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Settings') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
