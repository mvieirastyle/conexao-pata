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
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> {{ __('adoption.title', ['name' =>
                        $animal->nome]) }}</h4>
                </div>

                <div class="card-body">
                    <!-- DADOS PESSOAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_personal_data') }}</h5>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label"> {!! __('adoption.label_full_name') !!} </label>
                            <p class="form-control-plaintext">{{ old('full_name', $formAdoption->full_name ??
                                (Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '')) }}</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">{!! __('adoption.label_email') !!}</label>
                            <p class="form-control-plaintext">{{ old('email', $formAdoption->email ?? (Auth::check() ?
                                Auth::user()->email : '')) }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{!! __('adoption.label_birth_date') !!}</label>
                            <p class="form-control-plaintext">{{ old('birth_date', $formAdoption->birth_date ?? '') }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{!! __('adoption.label_nationality') !!}</label>
                            <p class="form-control-plaintext">{{ old('nationality', $formAdoption->nationality ?? '') }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{!! __('adoption.label_id_number') !!}</label>
                            <p class="form-control-plaintext">{{ old('id_number', $formAdoption->id_number ?? '') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{!! __('adoption.label_phone') !!}</label>
                            <p class="form-control-plaintext">{{ old('phone', $formAdoption->phone ?? '') }}</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">{!! __('adoption.label_address') !!}</label>
                            <p class="form-control-plaintext">{{ old('address', $formAdoption->address ?? '') }}</p>
                        </div>
                    </div>

                    <!-- ANIMAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_animals') }}</h5>
                    <label class="form-label">{!! __('adoption.label_have_animals') !!}</label>
                    <p class="form-control-plaintext">{{ implode(', ', old('animals', $formAdoption->animals ?? [])) ?:
                        '-' }}</p>

                    <!-- RESIDÊNCIA -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_residence') }}</h5>
                    <label class="form-label">{!! __('adoption.label_residence_type') !!}</label>
                    <p class="form-control-plaintext">{{ implode(', ', old('residence_type',
                        $formAdoption->residence_type ?? [])) ?: '-' }}</p>

                    <label class="form-label">{!! __('adoption.label_wall_height') !!}</label>
                    <p class="form-control-plaintext">{{ old('wall_height', $formAdoption->wall_height ?? '-') }}</p>

                    <!-- DISPONIBILIDADE -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('adoption.section_questions') }}</h5>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_1') !!}</label>
                        <p class="form-control-plaintext">{{ old('lifestyle', $formAdoption->lifestyle ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_2') !!}</label>
                        <p class="form-control-plaintext">{{ old('daily_routine', $formAdoption->daily_routine ?? '-')
                            }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_3') !!}</label>
                        <p class="form-control-plaintext">{{ old('dog_walks', $formAdoption->dog_walks ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_4') !!}</label>
                        <p class="form-control-plaintext">{{ old('house_access', $formAdoption->house_access ?? '-') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_5') !!}</label>
                        <p class="form-control-plaintext">{{ old('vacation_plans', $formAdoption->vacation_plans ?? '-')
                            }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_6') !!}</label>
                        <p class="form-control-plaintext">{{ old('veterinarian', $formAdoption->veterinarian ?? '-') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_7') !!}</label>
                        <p class="form-control-plaintext">{{ old('past_animals', $formAdoption->past_animals ?? '-') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_8') !!}</label>
                        <p class="form-control-plaintext">{{ old('concerns', $formAdoption->concerns ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_9') !!}</label>
                        <p class="form-control-plaintext">{{ old('unacceptable_behaviors',
                            $formAdoption->unacceptable_behaviors ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_10') !!}</label>
                        <p class="form-control-plaintext">{{ old('undesired_behaviors',
                            $formAdoption->undesired_behaviors ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_11') !!}</label>
                        <p class="form-control-plaintext">{{ old('dog_training', $formAdoption->dog_training ?? '-') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_12') !!}</label>
                        <p class="form-control-plaintext">{{ old('adoption_decision', $formAdoption->adoption_decision
                            ?? '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_13') !!}</label>
                        <p class="form-control-plaintext">{{ old('life_changes', $formAdoption->life_changes ?? '-') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_14') !!}</label>
                        <p class="form-control-plaintext">{{ old('past_separations', $formAdoption->past_separations ??
                            '-') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{!! __('adoption.question_15') !!}</label>
                        <p class="form-control-plaintext">{{ old('family_constraints', $formAdoption->family_constraints
                            ?? '-') }}</p>
                    </div>

                    @if (!$formAdoption->accept)
                    <div class="d-grid gap-2">
                        <form method="POST" action="/admin/animal/adoption-request/{{ $formAdoption->id }}/reject">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg">
                                Negar pedido de adoção
                            </button>
                        </form>

                        <form method="POST" action="/admin/animal/adoption-requests/{{ $formAdoption->id }}/accept">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-lg">
                                Aceitar pedido de adoção
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection