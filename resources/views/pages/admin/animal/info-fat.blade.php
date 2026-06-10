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
                        <i class="fas fa-plus-circle"></i> {{ __('volunteer.fat_title') }}
                    </h4>
                </div>

                <div class="card-body">

                    <!-- DADOS PESSOAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_personal_data') }}
                    </h5>

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_full_name') }}</label>
                            <input type="text" class="form-control" value="{{ $formFat->full_name ?? '' }}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_email') }}</label>
                            <input type="email" class="form-control" value="{{ $formFat->email ?? '' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_birth_date') }}</label>
                            <input type="date" class="form-control" value="{{ $formFat->birth_date ?? '' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_nationality') }}</label>
                            <input type="text" class="form-control" value="{{ $formFat->nationality ?? '' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_id_number') }}</label>
                            <input type="text" class="form-control" value="{{ $formFat->id_number ?? '' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_phone') }}</label>
                            <input type="text" class="form-control" value="{{ $formFat->phone ?? '' }}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_fat_experience') }}</label>
                            <textarea class="form-control" disabled>{{ $formFat->fat_experience ?? '' }}</textarea>
                        </div>

                    </div>

                    <!-- ANIMAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_animals') }}
                    </h5>

                    @php $animals = $formFat->animals ?? []; @endphp

                    @foreach(['dog','cat','other','none'] as $animal)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $animal }}" {{ in_array($animal,
                            $animals) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.animal_'.$animal) }}
                        </label>
                    </div>
                    @endforeach

                    <!-- DISPONIBILIDADE -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_availability') }}
                    </h5>

                    @php $availability = $formFat->availability ?? ''; @endphp

                    @foreach([
                    'dog_mother_and_pups',
                    'dog_puppies',
                    'dog_adults',
                    'cat_mother_and_pups',
                    'cat_kittens',
                    'cat_adults',
                    'sick_dogs',
                    'sick_cats'
                    ] as $opt)

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="{{ $opt }}" {{ $availability==$opt
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.availability_'.$opt) }}
                        </label>
                    </div>

                    @endforeach

                    <!-- RESIDÊNCIA -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_residence') }}
                    </h5>

                    @php $residence = $formFat->residence_type ?? []; @endphp

                    @foreach(['apartment','house','farm'] as $res)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $res }}" {{ in_array($res, $residence)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.residence_'.$res) }}
                        </label>
                    </div>
                    @endforeach

                    <!-- TERMOS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_terms') }}
                    </h5>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" {{ $formFat->accident_responsibility ? 'checked'
                        : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.term_accident_responsibility') }}
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" {{ $formFat->adaptation_terms ? 'checked' : ''
                        }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.term_adaptation') }}
                        </label>
                    </div>
                    @if (!$formFat->accept)
                    <div class="d-flex gap-3" style="flex-direction: row;">
                        <form method="POST" action="/admin/animal/fat-requests/{{ $formFat->id }}/reject">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg">
                                {{ __('volunteer.reject_fat_request') }}
                            </button>
                        </form>

                        <form method="POST" action="/admin/animal/fat-requests/{{ $formFat->id }}/accept">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-lg">
                                {{ __('volunteer.accept_fat_request') }}
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
