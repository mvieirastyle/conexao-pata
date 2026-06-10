@extends('layouts.admin')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
        @endif

        <div class="col-lg-10">
            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        {{ __('adoption.title', ['name' => $animal->nome]) }}
                    </h4>
                </div>

                <div class="card-body">

                    <!-- DADOS PESSOAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('adoption.section_personal_data') }}
                    </h5>

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label>{!! __('adoption.label_full_name') !!}</label>
                            <input type="text" class="form-control"
                                value="{{ old('full_name', $formAdoption->full_name ?? '') }}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{!! __('adoption.label_email') !!}</label>
                            <input type="email" class="form-control"
                                value="{{ old('email', $formAdoption->email ?? '') }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{!! __('adoption.label_birth_date') !!}</label>
                            <input type="date" class="form-control"
                                value="{{ old('birth_date', $formAdoption->birth_date ?? '') }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{!! __('adoption.label_nationality') !!}</label>
                            <input type="text" class="form-control"
                                value="{{ old('nationality', $formAdoption->nationality ?? '') }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{!! __('adoption.label_id_number') !!}</label>
                            <input type="text" class="form-control"
                                value="{{ old('id_number', $formAdoption->id_number ?? '') }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{!! __('adoption.label_phone') !!}</label>
                            <input type="text" class="form-control"
                                value="{{ old('phone', $formAdoption->phone ?? '') }}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{!! __('adoption.label_address') !!}</label>
                            <input type="text" class="form-control"
                                value="{{ old('address', $formAdoption->address ?? '') }}" disabled>
                        </div>

                    </div>

                    <!-- ANIMAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('adoption.section_animals') }}
                    </h5>

                    @php $animals = old('animals', $formAdoption->animals ?? []); @endphp

                    @foreach(['dog','cat','other','none'] as $animalOpt)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"
                            value="{{ $animalOpt }}"
                            {{ in_array($animalOpt, $animals) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('adoption.animal_'.$animalOpt) }}
                        </label>
                    </div>
                    @endforeach

                    <!-- RESIDÊNCIA -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('adoption.section_residence') }}
                    </h5>

                    @php $residence = old('residence_type', $formAdoption->residence_type ?? []); @endphp

                    @foreach(['apartment','house','farm'] as $res)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"
                            value="{{ $res }}"
                            {{ in_array($res, $residence) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('adoption.residence_'.$res) }}
                        </label>
                    </div>
                    @endforeach

                    <div class="mt-3">
                        <label>{!! __('adoption.label_wall_height') !!}</label>
                        <input type="text" class="form-control"
                            value="{{ old('wall_height', $formAdoption->wall_height ?? '') }}" disabled>
                    </div>

                    <!-- PERGUNTAS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('adoption.section_questions') }}
                    </h5>

                    @foreach([
                        'lifestyle',
                        'daily_routine',
                        'dog_walks',
                        'house_access',
                        'vacation_plans',
                        'veterinarian',
                        'past_animals',
                        'concerns',
                        'unacceptable_behaviors',
                        'undesired_behaviors',
                        'dog_training',
                        'adoption_decision',
                        'life_changes',
                        'past_separations',
                        'family_constraints'
                    ] as $index => $field)

                    <div class="mb-3">
                        <label>{!! __('adoption.question_'.($index+1)) !!}</label>
                        <textarea class="form-control" disabled>
{{ old($field, $formAdoption->$field ?? '') }}
                        </textarea>
                    </div>

                    @endforeach

                    <!-- AÇÕES -->
                    @if (!$formAdoption->accept)
                    <div class="d-flex gap-3 mt-4">

                        <form method="POST" action="/admin/animal/adoption-request/{{ $formAdoption->id }}/reject">
                            @csrf
                            <button class="btn btn-outline-danger btn-lg">
                                {{ __('adoption.reject_request') }}
                            </button>
                        </form>

                        <form method="POST" action="/admin/animal/adoption-requests/{{ $formAdoption->id }}/accept">
                            @csrf
                            <button class="btn btn-outline-success btn-lg">
                                {{ __('adoption.accept_request') }}
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
