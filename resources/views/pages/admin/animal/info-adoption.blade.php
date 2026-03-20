@extends('layouts.admin')

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
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> {{ __('adoption.title', ['name' => $animal->nome]) }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-adoption/{{ $animal->id }}" enctype="multipart/form-data">
                        @csrf
                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_personal_data') }}</h5>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('adoption.label_full_name') }}</label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ old('full_name', $formAdoption->full_name ?? (Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '')) }}"
                                    name="full_name" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('adoption.label_email') }}</label>
                                <input type="email"
                                    class="form-control"
                                    value="{{ old('email', $formAdoption->email ?? (Auth::check() ? Auth::user()->email : '')) }}"
                                    name="email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('adoption.label_birth_date') }}</label>
                                <input type="date" class="form-control"
                                    value="{{ old('birth_date', $formAdoption->birth_date ?? '') }}"
                                    name="birth_date" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('adoption.label_nationality') }}</label>
                                <input type="text" class="form-control"
                                    value="{{ old('nationality', $formAdoption->nationality ?? '') }}"
                                    name="nationality" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('adoption.label_id_number') }}</label>
                                <input type="text" class="form-control"
                                    value="{{ old('id_number', $formAdoption->id_number ?? '') }}"
                                    name="id_number" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('adoption.label_phone') }}</label>
                                <input type="text" class="form-control"
                                    value="{{ old('phone', $formAdoption->phone ?? '') }}"
                                    name="phone" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('adoption.label_address') }}</label>
                                <input type="text" class="form-control"
                                    value="{{ old('address', $formAdoption->address ?? '') }}"
                                    name="address" required>
                            </div>
                        </div>

                        <!-- ANIMAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_animals') }}</h5>

                        <label class="form-label">{{ __('adoption.label_have_animals') }}</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="dog"
                                {{ in_array('dog', old('animals', $formAdoption->animals ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.animal_dog') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="cat"
                                {{ in_array('cat', old('animals', $formAdoption->animals ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.animal_cat') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="other"
                                {{ in_array('other', old('animals', $formAdoption->animals ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.animal_other') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="none"
                                {{ in_array('none', old('animals', $formAdoption->animals ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.animal_none') }}</label>
                        </div>

                        <!-- RESIDÊNCIA -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_residence') }}</h5>
                        <label class="form-label">{{ __('adoption.label_residence_type') }}</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="apartment"
                                {{ in_array('apartment', old('residence_type', $formAdoption->residence_type ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.residence_apartment') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="house"
                                {{ in_array('house', old('residence_type', $formAdoption->residence_type ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.residence_house') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="farm"
                                {{ in_array('farm', old('residence_type', $formAdoption->residence_type ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.residence_farm') }}</label>
                        </div>

                        <label class="form-label">{{ __('adoption.label_wall_height') }}</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="none"
                                {{ old('wall_height', $formAdoption->wall_height ?? '') === 'none' ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.wall_height_none') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="low"
                                {{ old('wall_height', $formAdoption->wall_height ?? '') === 'low' ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.wall_height_low') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="high"
                                {{ old('wall_height', $formAdoption->wall_height ?? '') === 'high' ? 'checked' : '' }}>
                            <label class="form-check-label">{{ __('adoption.wall_height_high') }}</label>
                        </div>

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_questions') }}</h5>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_1') }}</label>
                            <textarea class="form-control" name="lifestyle" rows="2">{{ old('lifestyle', $formAdoption->lifestyle ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_2') }}</label>
                            <textarea class="form-control" name="daily_routine" rows="2">{{ old('daily_routine', $formAdoption->daily_routine ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_3') }}</label>
                            <textarea class="form-control" name="dog_walks" rows="2">{{ old('dog_walks', $formAdoption->dog_walks ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_4') }}</label>
                            <textarea class="form-control" name="house_access" rows="2">{{ old('house_access', $formAdoption->house_access ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_5') }}</label>
                            <textarea class="form-control" name="vacation_plans" rows="2">{{ old('vacation_plans', $formAdoption->vacation_plans ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_6') }}</label>
                            <textarea class="form-control" name="veterinarian" rows="2">{{ old('veterinarian', $formAdoption->veterinarian ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_7') }}</label>
                            <textarea class="form-control" name="past_animals" rows="2">{{ old('past_animals', $formAdoption->past_animals ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_8') }}</label>
                            <textarea class="form-control" name="concerns" rows="2">{{ old('concerns', $formAdoption->concerns ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_9') }}</label>
                            <textarea class="form-control" name="unacceptable_behaviors" rows="2">{{ old('unacceptable_behaviors', $formAdoption->unacceptable_behaviors ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_10') }}</label>
                            <textarea class="form-control" name="undesired_behaviors" rows="2">{{ old('undesired_behaviors', $formAdoption->undesired_behaviors ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_11') }}</label>
                            <textarea class="form-control" name="dog_training" rows="2">{{ old('dog_training', $formAdoption->dog_training ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_12') }}</label>
                            <textarea class="form-control" name="adoption_decision" rows="2">{{ old('adoption_decision', $formAdoption->adoption_decision ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_13') }}</label>
                            <textarea class="form-control" name="life_changes" rows="2">{{ old('life_changes', $formAdoption->life_changes ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_14') }}</label>
                            <textarea class="form-control" name="past_separations" rows="2">{{ old('past_separations', $formAdoption->past_separations ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('adoption.question_15') }}</label>
                            <textarea class="form-control" name="family_constraints" rows="2">{{ old('family_constraints', $formAdoption->family_constraints ?? '') }}</textarea>
                        </div>

                        <!-- RESPONSABILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_terms') }}</h5>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="responsibility" value="1"
                                {{ old('responsibility', $formAdoption->responsibility ? '1' : null) ? 'checked' : '' }}>
                            <label class="form-check-label small">
                                {{ __('adoption.term_responsibility') }}
                            </label>
                        </div>

                         <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger btn-lg">
                               Negar pedido de adoção
                            </button>
                        </div>
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-outline-success btn-lg">
                               Aceitar pedido de adoção
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
