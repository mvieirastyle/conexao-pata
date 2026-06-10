@extends('layouts.default')

@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f0f2f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 rounded-lg">

                    <div class="card-header bg-success text-white text-center py-4">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-envelope-open-text me-2"></i>{{ __('pass.verify_email_title') }}
                        </h3>
                    </div>

                    <div class="card-body p-4 text-center">

                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif

                        <p class="mb-4">
                            {!! __('pass.verify_email_text') !!}
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg text-white">
                                    <i class="fas fa-paper-plane me-2"></i>{{ __('pass.resend_email') }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

                <div class="card-footer text-center py-3 bg-light">
                    <p class="mb-0 small">
                        {{ __('pass.verify_email_footer') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

@endsection
