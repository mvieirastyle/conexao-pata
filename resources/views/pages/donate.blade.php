@extends('layouts.default')

@section('content')
<section class="py-5 bg-orange text-white header-small"
    style="background-image: -moz-linear-gradient( #e26600c2, #fc860093), url('images/DonateImg.jpg'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <h1 class="display-4">{{ __('donate.title') }}</h1>
        <p class="lead">{{ __('donate.lead') }}</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">{{ __('donate.title') }}</h3>
                <p>{{ __('donate.text_one') }}</p>
                <p>{{ __('donate.text_two') }}</p>
                <p>{{ __('donate.text_three') }}</p>
                <p>{{ __('donate.text_four') }}</p>
                <p>{!! __('donate.text_five') !!}</p>

            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-2">
                <img src="images/DonateDog.jpg" class="img-fluid rounded shadow"
                    alt="Batalha Landscape">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="section-title">{{ __('donate.how_to_donate_title') }}</h3>
                <p>
                    {{ __('donate.how_to_donate_desc') }}
                </p>

                <p>{{ __('donate.support_methods') }}</p>

                <h5 style="color: #0ebb56">
                    <i class="fa-solid fa-hand-holding-medical" style="color: #e67e22;"></i>
                    <strong>{{ __('donate.in_kind_title') }}</strong>
                </h5>

                <p>{{ __('donate.in_kind_desc') }}</p>

                <ul style="list-style: none; padding-left: 0;">
                    <li><i class="fa-solid fa-bone" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_food') }}</li>
                    <li><i class="fa-solid fa-bug-slash" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_collars') }}</li>
                    <li><i class="fa-solid fa-microchip" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_microchip') }}</li>
                    <li><i class="fa-solid fa-dog" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_leads') }}</li>
                    <li><i class="fa-solid fa-pills" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_meds') }}</li>
                    <li><i class="fa-solid fa-broom" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_cleaning') }}</li>
                    <li><i class="fa-solid fa-cat" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_litter') }}</li>
                    <li><i class="fa-solid fa-house" style="color: #e67e22;"></i> {{ __('donate.in_kind_item_beds') }}</li>
                </ul>

                <p>{!! __('donate.needs_list') !!}</p>

                <h5 style="color: #0ebb56">
                    <i class="fa-solid fa-hand-holding-dollar" style="color: #e67e22;"></i> <strong>{{ __('donate.financial_title') }}</strong>
                </h5>

                <p>
                    {{ __('donate.financial_desc') }}
                </p>

                <ul style="list-style: none; padding-left: 0;">
                    <li><i class="fa-brands fa-paypal" style="color: #e67e22;"></i> {{ __('donate.payment_paypal') }}</li>
                    <li><i class="fa-solid fa-wallet" style="color: #e67e22;"></i> {{ __('donate.payment_mbway') }}</li>
                    <li><i class="fa-solid fa-university" style="color: #e67e22;"></i> {{ __('donate.payment_bank') }}</li>

            </div>
        </div>
    </div>
</section>
@endsection