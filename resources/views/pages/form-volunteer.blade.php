@extends('layouts.default')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Juntar-se ao voluntariado</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-volunteer" enctype="multipart/form-data">
                        @csrf

                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Dados Pessoais</h5>

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nome Completo / Full Name *</label>
                                <input type="text" value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}" class="form-control" name="full_name" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">E-mail / Email *</label>
                                <input type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" class="form-control" name="email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data de Nascimento / Date of Birth *</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nacionalidade / Nationality *</label>
                                <input type="text" class="form-control" name="nationality" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Número do Documento de Identificação / ID Number *</label>
                                <input type="text" class="form-control" name="id_number" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Número de Telemóvel / Phone Number *</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Morada / Address *</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ocupação / Occupation *</label>
                                <input type="text" class="form-control" name="occupation" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Empresa / Escola / Faculdade</label>
                                <input type="text" class="form-control" name="company_school">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Hobbies *</label>
                                <textarea class="form-control" name="hobbies" rows="2"></textarea>
                            </div>

                        </div>

                        <!-- ANIMAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Animais</h5>

                        <label class="form-label">Tem animais? Quais?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="dog">
                            <label class="form-check-label">Cão / Dog</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="cat">
                            <label class="form-check-label">Gato / Cat</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="other">
                            <label class="form-check-label">Outro / Other</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="animals[]" value="none">
                            <label class="form-check-label">Não tenho nenhum animal</label>
                        </div>

                        <!-- TRANSPORTE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Transporte</h5>

                        <label class="form-label">Meio de transporte para o Abrigo</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="car">
                            <label class="form-check-label">Viatura Própria</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="public">
                            <label class="form-check-label">Transportes Públicos</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transport" value="ride">
                            <label class="form-check-label">Boleia</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="transport" value="walk">
                            <label class="form-check-label">A pé</label>
                        </div>

                        <!-- LOCAL -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Área de Voluntariado</h5>

                        <label class="form-label">Onde pretende realizar voluntariado?</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="area[]" value="kennel">
                            <label class="form-check-label">Canil</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="area[]" value="cattery">
                            <label class="form-check-label">Gatil</label>
                        </div>

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Disponibilidade</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="campaigns">
                            <label class="form-check-label">Campanhas de Recolha de Bens</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="fairs">
                            <label class="form-check-label">Feiras de Voluntariado</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="awareness">
                            <label class="form-check-label">Ações de Sensibilização</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activities[]"
                                value="transport_animals">
                            <label class="form-check-label">Transporte de Animais</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="activities[]" value="admin_tasks">
                            <label class="form-check-label">Tarefas Administrativas</label>
                        </div>

                        <!-- CURSOS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Cursos relacionados com animais</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="trainer">
                            <label class="form-check-label">Treinador</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="vet_assistant">
                            <label class="form-check-label">Auxiliar de Veterinária</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="vet">
                            <label class="form-check-label">Médico Veterinário</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="other">
                            <label class="form-check-label">Outro</label>
                        </div>

                        <!-- RESPONSABILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Termos</h5>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accident_responsibility" required>
                            <label class="form-check-label">
                                Declaro assumir a responsabilidade por qualquer acidente que possa ocorrer no Abrigo
                            </label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="adaptation_terms" required>
                            <label class="form-check-label">
                                Declaro ter autonomia na realização de tarefas e não ter necessidades específicas de
                                adaptação
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Enviar candidatura
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
                <h5 class="modal-title"><i class="fa-solid fa-triangle-exclamation" style="color: #ff8b26;"></i> Pontos
                    importantes a considerar antes de prosseguir</h5>
                <button type="button" class="btn-close" id="closeBtn" disabled data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h4>Requisitos para Voluntariado</h4>
                <ul>
                    <li>É necessário compromisso e assiduidade: mínimo <strong>3 horas seguidas, 1 vez por
                            semana</strong>.</li>
                    <li>Voluntários <strong>sem experiência</strong> participam <strong>durante a tarde</strong> (manhã
                        reservada para experientes).</li>
                    <li><strong>Canil:</strong> maiores de <strong>18 anos</strong>.</li>
                    <li><strong>Gatil:</strong> maiores de <strong>16 anos</strong>, com <strong>termo de
                            responsabilidade assinado por um tutor</strong>.</li>
                    <li>Inscrições de pessoas com <strong>necessidades específicas/adaptações</strong> devem ser
                        previamente alinhadas pelo email
                        <a href="mailto:admin@batalha.pt">admin@batalha.pt</a>.
                    </li>
                </ul>

                <h4>Tarefas do Voluntário</h4>
                <ul>
                    <li>Limpar <strong>boxes e gatis</strong>.</li>
                    <li><strong>Soltar os cães</strong> no recreio.</li>
                    <li>Verificar <strong>camas, mantas e água</strong>.</li>
                    <li><strong>Apanhar dejetos</strong> nas boxes/gatis e no recreio.</li>
                    <li><strong>Lavar, estender, apanhar e guardar mantas</strong>.</li>
                    <li>Levar <strong>mantas sujas</strong> para lavagem.</li>
                    <li><strong>Comunicar situações relevantes</strong> à Direção ou aos Médicos Veterinários.</li>
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