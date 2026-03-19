@extends('layouts.default')

@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f0f2f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 rounded-lg">

                    <div class="card-header bg-success text-white text-center py-4">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-key me-2"></i>{{ __('pass.title') }}
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="/forgot-password">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">{{ __('pass.email_label') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="{{ __('pass.email_placeholder') }}"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{  }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="text-muted">
                                    {{ __('pass.help_text') }}
                                </small>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg text-white">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('pass.send_button') }}
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
                        <p class="mb-0 small">{!!__('users.form.dont_have')!!}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
