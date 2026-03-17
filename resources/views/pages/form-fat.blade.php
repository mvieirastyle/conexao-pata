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
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Ser uma FAT (Família de Acolhimento Temporário)</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-fat" enctype="multipart/form-data">
                        @csrf
                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Dados Pessoais</h5>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nome Completo / Full Name *</label>
                                <input type="text" value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"  class="form-control" name="full_name" required>
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
                                <label class="form-label">Experiência como FAT (se houver):</label>
                                <textarea class="form-control" name="fat_experience"></textarea>
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

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Disponibilidade</h5>
                        <label class="form-label">Posso ser FAT de:</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_mother_and_pups">
                            <label class="form-check-label">Mãe e ninhada (cães)</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_puppies">
                            <label class="form-check-label">Cães bebés</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="dog_adults">
                            <label class="form-check-label">Cães adultos</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_mother_and_pups">
                            <label class="form-check-label">Mãe e ninhada (gatos)</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_kittens">
                            <label class="form-check-label">Gatos bebés</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="cat_adults">
                            <label class="form-check-label">Gatos adultos</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="sick_dogs">
                            <label class="form-check-label">Cães doentes</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="availability" value="sick_cats">
                            <label class="form-check-label">Gatos doentes</label>
                        </div>

                        <!-- RESIDÊNCIA -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Residência</h5>
                        <label class="form-label">Qual seu tipo de residência?</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="apartment">
                            <label class="form-check-label">Apartamento</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="house">
                            <label class="form-check-label">Moradia</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="residence_type[]" value="farm">
                            <label class="form-check-label">Quinta</label>
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
                                Declaro ter autonomia na realização de tarefas e não ter necessidades específicas de adaptação
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

@endsection