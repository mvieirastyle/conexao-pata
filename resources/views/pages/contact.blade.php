@extends('layouts.default')

@section('content')
<header class="py-5 bg-dark-green text-white header-small" style="background-color: var(--dark-green);">
    <div class="container text-center">
        <h1 class="display-4">{{__('front_end.contact.title')}}</h1>
        <p class="lead">{{__('front_end.contact.subtitle')}}</p>
    </div>
</header>
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

        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-5 mb-5">
                <h3 class="section-title">{{__('front_end.contact.info')}}</h3>
                <p class="mb-4">{{__('front_end.contact.text_info')}}</p>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="ms-3">
                        <h5>{{__('front_end.contact.loc')}}</h5>
                        <p class="text-muted mb-0">Rua Cabeço da Freiria, 2440-036 Batalha<br>Portugal</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="ms-3">
                        <h5>{{__('front_end.contact.phone')}}</h5>
                        <p class="text-muted mb-0">+351 967 287 901</p>
                        <small class="text-muted">{{__('front_end.contact.obs')}}</small>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 btn-lg btn-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ms-3">
                        <h5>Email</h5>
                        <p class="text-muted mb-0">geral@cm-batalha.pt</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4">{{__('front_end.contact.title_message')}}</h3>
                        <form method="POST" action="/contact" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="full_name" class="form-label">{{__('front_end.contact.name')}}</label>
                                    <input type="text"
                                        value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"
                                        class="form-control" name="full_name" id="full_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                        class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">{{__('front_end.contact.topic')}}</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">{{__('front_end.contact.message')}}</label>
                                <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                            </div>
                            <button type="submit"
                                class="btn btn-green btn-lg px-4">{{__('front_end.contact.message_button')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Maps -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="rounded overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3071.8431813445204!2d-8.818918925216416!3d39.653243671572696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22755dbaf6e5cb%3A0x8b20ce8aae97e0c6!2sR.%20Cabe%C3%A7o%20da%20Freiria%2C%20Batalha!5e0!3m2!1spt-PT!2spt!4v1773757348436!5m2!1spt-PT!2spt"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection