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
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Adoção do(a) {{ $animal->nome }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/form-adoption/{{ $animal->id }}" enctype="multipart/form-data">
                        @csrf
                        <!-- DADOS PESSOAIS -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Dados Pessoais</h5>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nome Completo / Full Name *</label>
                                <input type="text"
                                    value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"
                                    class="form-control" name="full_name" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">E-mail / Email *</label>
                                <input type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                    class="form-control" name="email" required>
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
                                <label class="form-label">Endereço / Address *</label>
                                <input type="text" class="form-control" name="address" required>
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

                        <label class="form-label">Caso tenha espaço exterior, é murado e que altura tem?</label>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="none">
                            <label class="form-check-label">Sem muro</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="low">
                            <label class="form-check-label">Muro baixo (até 1,5m)</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="wall_height" value="high">
                            <label class="form-check-label">Muro alto (acima de 1,5m)</label>
                        </div>

                        <!-- DISPONIBILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Perguntas</h5>

                        <div class="mb-3">
                            <label class="form-label">1. Como é o seu estilo de vida e em que atividades gostaria de
                                incluir o seu animal?</label>
                            <textarea class="form-control" name="lifestyle" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">2. Como seria o seu dia-a-dia típico deste animal, onde vai passar
                                a maior parte do tempo e quantas horas por dia precisa que fique sozinho?</label>
                            <textarea class="form-control" name="daily_routine" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CÃO - Quantas vezes por dia quer levar o seu cão à rua? Quando e
                                quanto tempo?</label>
                            <textarea class="form-control" name="dog_walks" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">3. Quais as divisões da casa a que o animal terá acesso? Onde
                                dormirá?</label>
                            <textarea class="form-control" name="house_access" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">4. Quais são os seus planos para o animal quando for de férias ou
                                viajar?</label>
                            <textarea class="form-control" name="vacation_plans" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">5. Conhece um veterinário de confiança para acompanhar o seu
                                cão/gato? Como se chama o médico e a clínica?</label>
                            <textarea class="form-control" name="veterinarian" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">6. Teve animais em criança ou já adulto? O que mais gostava neles?
                                Ainda estão consigo? O que lhes aconteceu?</label>
                            <textarea class="form-control" name="past_animals" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">7. O que o preocupa ou deixa inseguro quanto a adotar um
                                cão/gato?</label>
                            <textarea class="form-control" name="concerns" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">8. Quais os comportamentos que não aceitaria ou que acharia
                                difíceis de gerir?</label>
                            <textarea class="form-control" name="unacceptable_behaviors" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">9. Como vai lidar com os comportamentos indesejados do:
                                CÃO (como roer, estragar, fazer necessidades em casa, ladrar e ganir ou ser bruto e
                                irrequieto)
                                GATO (arranhar, estragar, miar, fazer necessidades fora da liteira)</label>
                            <textarea class="form-control" name="undesired_behaviors" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">10. CÃO - Seria capaz de recorrer a um treinador canino
                                profissional para o ajudar a resolver certos comportamentos atrás referidos? Já recorreu
                                a algum no passado? Obteve os resultados desejados?</label>
                            <textarea class="form-control" name="dog_trainer" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">11. Quando é que decidiu adotar um animal e o que o fez
                                decidir?</label>
                            <textarea class="form-control" name="adoption_decision" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">12. O que faria se a sua vida mudasse e tivesse dificuldades em
                                manter este animal?</label>
                            <textarea class="form-control" name="life_changes" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">13. Já teve algum animal do qual teve que se separar no passado ou
                                por força maior? O que aconteceu? A quem o entregou? Tem novidades do animal?</label>
                            <textarea class="form-control" name="past_separations" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">14. Alguém na sua família tem medo de animais ou alergias que
                                devam ser tidas em conta na escolha do animal?</label>
                            <textarea class="form-control" name="family_constraints" rows="2"></textarea>
                        </div>

                        <!-- RESPONSABILIDADE -->
                        <h5 class="mb-3 text-muted border-bottom pb-2">Termos</h5>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="responsibility" required>
                            <label class="form-check-label small">
                                Declaro que assumo total responsabilidade pelos cuidados, alimentação, segurança e
                                bem-estar do animal adotado, comprometendo-me a cumprir todas as normas do abrigo e a
                                fornecer atenção adequada ao animal. </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Enviar pré adoção
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection