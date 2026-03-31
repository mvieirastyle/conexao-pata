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
                        <i class="fas fa-plus-circle"></i> {{ __('volunteer.form_title') }}
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
                            <input type="text" class="form-control" value="{{ $formVolunteer->full_name ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_email') }}</label>
                            <input type="email" class="form-control" value="{{ $formVolunteer->email ?? '' }}" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_birth_date') }}</label>
                            <input type="date" class="form-control" value="{{ $formVolunteer->birth_date ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_nationality') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->nationality ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_id_number') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->id_number ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_phone') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->phone ?? '' }}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_address') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->address ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_occupation') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->occupation ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('volunteer.label_company_school') }}</label>
                            <input type="text" class="form-control" value="{{ $formVolunteer->company_school ?? '' }}"
                                disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{ __('volunteer.label_hobbies') }}</label>
                            <textarea class="form-control" disabled>{{ $formVolunteer->hobbies ?? '' }}</textarea>
                        </div>

                    </div>

                    <!-- ANIMAIS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_animals') }}
                    </h5>

                    <label>{{ __('volunteer.label_have_animals') }}</label>

                    @php $animals = $formVolunteer->animals ?? []; @endphp

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="dog" {{ in_array('dog', $animals)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.animal_dog') }}</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="cat" {{ in_array('cat', $animals)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.animal_cat') }}</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="other" {{ in_array('other', $animals)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.animal_other') }}</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" value="none" {{ in_array('none', $animals)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.animal_none') }}</label>
                    </div>

                    <!-- TRANSPORTE -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_transport') }}
                    </h5>

                    @php $transport = $formVolunteer->transport ?? ''; @endphp

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="car" {{ $transport=='car' ? 'checked' : ''
                            }} disabled>
                        <label class="form-check-label">{{ __('volunteer.transport_car') }}</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="public" {{ $transport=='public' ? 'checked'
                            : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.transport_public') }}</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="ride" {{ $transport=='ride' ? 'checked' : ''
                            }} disabled>
                        <label class="form-check-label">{{ __('volunteer.transport_ride') }}</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" value="walk" {{ $transport=='walk' ? 'checked' : ''
                            }} disabled>
                        <label class="form-check-label">{{ __('volunteer.transport_walk') }}</label>
                    </div>

                    <!-- AREA -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_area') }}
                    </h5>

                    @php $area = $formVolunteer->area ?? []; @endphp

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="kennel" {{ in_array('kennel', $area)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.area_kennel') }}</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" value="cattery" {{ in_array('cattery', $area)
                            ? 'checked' : '' }} disabled>
                        <label class="form-check-label">{{ __('volunteer.area_cattery') }}</label>
                    </div>

                    <!-- ATIVIDADES -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_availability') }}
                    </h5>

                    @php $activities = $formVolunteer->activities ?? []; @endphp

                    @foreach(['campaigns','fairs','awareness','transport_animals','admin_tasks'] as $act)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $act }}" {{ in_array($act,
                            $activities) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.activity_'.$act) }}
                        </label>
                    </div>
                    @endforeach

                    <!-- CURSOS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_courses') }}
                    </h5>

                    @php $courses = $formVolunteer->courses ?? []; @endphp

                    @foreach(['trainer','vet_assistant','vet','other'] as $course)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $course }}" {{ in_array($course,
                            $courses) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.course_'.$course) }}
                        </label>
                    </div>
                    @endforeach

                    <!-- TERMOS -->
                    <h5 class="mb-3 text-muted border-bottom pb-2">
                        {{ __('volunteer.section_terms') }}
                    </h5>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" {{ $formVolunteer->accident_responsibility ?
                        'checked' : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.term_accident_responsibility') }}
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" {{ $formVolunteer->adaptation_terms ? 'checked'
                        : '' }} disabled>
                        <label class="form-check-label">
                            {{ __('volunteer.term_adaptation') }}
                        </label>
                    </div>
                    @if (!$formVolunteer->accept)
                    <div class="d-flex gap-3" style="flex-direction: row;">
                        <form method="POST" action="/admin/animal/volunteer-requests/{{ $formVolunteer->id }}/reject">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg">
                                Negar pedido de Voluntariado
                            </button>
                        </form>

                        <form method="POST" action="/admin/animal/volunteer-requests/{{ $formVolunteer->id }}/accept">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-lg">
                                Aceitar pedido de Voluntariado
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