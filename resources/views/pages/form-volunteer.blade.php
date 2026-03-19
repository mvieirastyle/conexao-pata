@extends('layouts.default')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> {{ __('volunteer.form_title') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-volunteer" enctype="multipart/form-data">
                        @csrf

                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_personal_data') }}</h5>

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('volunteer.label_full_name') }}</label>
                                <input type="text" value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}" class="form-control" name="full_name" required>
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
                                <label class="form-label">{{ __('volunteer.label_address') }}</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_occupation') }}</label>
                                <input type="text" class="form-control" name="occupation" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('volunteer.label_company_school') }}</label>
                                <input type="text" class="form-control" name="company_school">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">{{ __('volunteer.label_hobbies') }}</label>
                                <textarea class="form-control" name="hobbies" rows="2"></textarea>
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

                        <!-- TRANSPORTE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_transport') }}</h5>

                        <label class="form-label">{{ __('volunteer.label_transport') }}</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="car">
                            <label class="form-check-label">{{ __('volunteer.transport_car') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="public">
                            <label class="form-check-label">{{ __('volunteer.transport_public') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="ride">
                            <label class="form-check-label">{{ __('volunteer.transport_ride') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="transport" value="walk">
                            <label class="form-check-label">{{ __('volunteer.transport_walk') }}</label>
                        </div>

                        <!-- LOCAL -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_area') }}</h5>

                        <label class="form-label">{{ __('volunteer.label_area') }}</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="area[]" value="kennel">
                            <label class="form-check-label">{{ __('volunteer.area_kennel') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="area[]" value="cattery">
                            <label class="form-check-label">{{ __('volunteer.area_cattery') }}</label>
                        </div>

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_availability') }}</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="campaigns">
                            <label class="form-check-label">{{ __('volunteer.activity_campaigns') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="fairs">
                            <label class="form-check-label">{{ __('volunteer.activity_fairs') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="awareness">
                            <label class="form-check-label">{{ __('volunteer.activity_awareness') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]"
                                value="transport_animals">
                            <label class="form-check-label">{{ __('volunteer.activity_transport_animals') }}</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="admin_tasks">
                            <label class="form-check-label">{{ __('volunteer.activity_admin_tasks') }}</label>
                        </div>

                        <!-- CURSOS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">{{ __('volunteer.section_courses') }}</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="trainer">
                            <label class="form-check-label">{{ __('volunteer.course_trainer') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="vet_assistant">
                            <label class="form-check-label">{{ __('volunteer.course_vet_assistant') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="vet">
                            <label class="form-check-label">{{ __('volunteer.course_vet') }}</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="other">
                            <label class="form-check-label">{{ __('volunteer.course_other') }}</label>
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

<!-- Modal -->
<div class="modal fade" id="volunteerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-triangle-exclamation" style="color: #ff8b26;"></i> {{ __('volunteer.modal_title') }}</h5>
                <button type="button" class="btn-close" id="closeBtn" disabled data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h4>{{ __('volunteer.modal_requirements_title') }}</h4>
                <ul>
                    <li>{!! __('volunteer.modal_req_1') !!}</li>
                    <li>{!! __('volunteer.modal_req_2') !!}</li>
                    <li>{!! __('volunteer.modal_req_3') !!}</li>
                    <li>{!! __('volunteer.modal_req_4') !!}</li>
                    <li>{!! __('volunteer.modal_req_5') !!}</li>
                </ul>

                <h4>{{ __('volunteer.modal_tasks_title') }}</h4>
                <ul>
                    <li>{!! __('volunteer.modal_task_1') !!}</li>
                    <li>{!! __('volunteer.modal_task_2') !!}</li>
                    <li>{!! __('volunteer.modal_task_3') !!}</li>
                    <li>{!! __('volunteer.modal_task_4') !!}</li>
                    <li>{!! __('volunteer.modal_task_5') !!}</li>
                    <li>{!! __('volunteer.modal_task_6') !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

  const modalElement = document.getElementById('volunteerModal');
  const modal = new bootstrap.Modal(modalElement);
  const closeBtn = document.getElementById('closeBtn');

  // show modal automatically
  modal.show();

  // enable close after 3 seconds
  setTimeout(() => {
    closeBtn.disabled = false;
  }, 3000);

});
</script>
@endsection
