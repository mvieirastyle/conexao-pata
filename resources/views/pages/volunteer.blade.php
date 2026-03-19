@extends('layouts.default')

@section('content')
<section class="py-5 bg-orange text-dark">
    <div class="container text-center">
        <h1 class="display-4" style="color: #e67e22;">{{ __('volunteer.page_title') }}</h1>
        <p class="lead">{{ __('volunteer.page_lead') }}</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row mb-5">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">{{ __('volunteer.section_title') }}</h3>
                <p>{{ __('volunteer.intro_1') }}</p>
                <p>{{ __('volunteer.intro_2') }}</p>
                <p>{{ __('volunteer.intro_3') }}</p>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-2">
                <img src="images/volunteerImg.jpg" class="img-fluid rounded shadow" alt="{{ __('volunteer.image_alt') }}">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="section-title">{{ __('volunteer.become_volunteer_title') }}</h3>
                <p>{{ __('volunteer.become_volunteer_para') }}</p>

                <p><strong>{{ __('volunteer.volunteer_cta') }}</strong></p>
                <a href="/form-volunteer" class="btn btn-orange">{{ __('volunteer.volunteer_button') }}</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">{{ __('volunteer.foster_title') }}</h3>
                <p>{{ __('volunteer.foster_para_1') }}</p>
                <p>{{ __('volunteer.foster_para_2') }}</p>
                <p>{{ __('volunteer.foster_para_3') }}</p>
                <p>{{ __('volunteer.foster_para_4') }}</p>

                <p><strong>{{ __('volunteer.foster_cta') }}</strong></p>

                <a href="/form-fat" class="btn btn-orange">{{ __('volunteer.foster_button') }}</a>
            </div>
        </div>
    </div>
</section>
@endsection
