@extends('layouts.default')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">

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
    
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> {{ __('volunteer.fat_title') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-fat" enctype="multipart/form-data">
                        @csrf
                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_personal_data') }}</h5>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('volunteer.label_full_name') }}</label>
                                <input type="text" value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"  class="form-control" name="full_name" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('volunteer.label_email') }}</label>
                                <input type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" class="form-control" name="email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_birth_date') }}</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>

                               <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_nationality') }}</label>
                                <input type="text" class="form-control" name="nationality" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_id_number') }}</label>
                                <input type="text" class="form-control" name="id_number" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_phone') }}</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('volunteer.label_fat_experience') }}</label>
                                <textarea class="form-control" name="fat_experience"></textarea>
                            </div>
                        </div>

                        <!-- ANIMAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_animals') }}</h5>

                        <label class="form-label">{{ __('volunteer.label_have_animals') }}</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="dog">
                            <label class="form-check-label">{{ __('volunteer.animal_dog') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="cat">
                            <label class="form-check-label">{{ __('volunteer.animal_cat') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="other">
                            <label class="form-check-label">{{ __('volunteer.animal_other') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="none">
                            <label class="form-check-label">{{ __('volunteer.animal_none') }}</label>
                        </div>

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_availability') }}</h5>
                        <label class="form-label">{{ __('volunteer.label_availability') }}</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_mother_and_pups">
                            <label class="form-check-label">{{ __('volunteer.availability_dog_mother_and_pups') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_puppies">
                            <label class="form-check-label">{{ __('volunteer.availability_dog_puppies') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_adults">
                            <label class="form-check-label">{{ __('volunteer.availability_dog_adults') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_mother_and_pups">
                            <label class="form-check-label">{{ __('volunteer.availability_cat_mother_and_pups') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_kittens">
                            <label class="form-check-label">{{ __('volunteer.availability_cat_kittens') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_adults">
                            <label class="form-check-label">{{ __('volunteer.availability_cat_adults') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="sick_dogs">
                            <label class="form-check-label">{{ __('volunteer.availability_sick_dogs') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="sick_cats">
                            <label class="form-check-label">{{ __('volunteer.availability_sick_cats') }}</label>
                        </div>

                        <!-- RESIDÊNCIA -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_residence') }}</h5>
                        <label class="form-label">{{ __('volunteer.label_residence_type') }}</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="apartment">
                            <label class="form-check-label">{{ __('volunteer.residence_apartment') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="house">
                            <label class="form-check-label">{{ __('volunteer.residence_house') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="farm">
                            <label class="form-check-label">{{ __('volunteer.residence_farm') }}</label>
                        </div>

                        <!-- RESPONSABILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_terms') }}</h5>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accident_responsibility" required>
                            <label class="form-check-label">
                                {{ __('volunteer.term_accident_responsibility') }}
                            </label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="adaptation_terms" required>
                            <label class="form-check-label">
                                {{ __('volunteer.term_adaptation') }}
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                {{ __('volunteer.submit_button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
