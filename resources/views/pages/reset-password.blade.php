@extends('layouts.default')

@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f0f2f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 rounded-lg">

                    <div class="card-header bg-success text-white text-center py-4">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-lock me-2"></i>{{ __('pass.reset_title') }}
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="/reset-password">
                            @csrf

                            {{-- TOKEN --}}
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('pass.email_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ request()->email }}"
                                        required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('pass.new_password_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">{{ __('pass.confirm_password_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg text-white">
                                    <i class="fas fa-save me-2"></i>{{ __('pass.reset_button') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="/login" class="small text-decoration-none text-success">
                                    <i class="fas fa-arrow-left me-1"></i>{{ __('pass.back_to_login') }}
                                </a>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer text-center py-3 bg-light">
                        <p class="mb-0 small">{{ __('pass.remember_password') }} <a href="/login" class="text-success">{{ __('pass.login') }}</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
