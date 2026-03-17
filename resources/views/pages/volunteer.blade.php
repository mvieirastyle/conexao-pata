@extends('layouts.default')

@section('content')
<section class="py-5 bg-orange text-dark">
    <div class="container text-center">
        <h1 class="display-4" style="color: #e67e22;">Voluntariado</h1>
        <p class="lead">Ajude nos a dar a estes animais uma segunda oportunidade</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        
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
    
        <div class="row mb-5">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">Voluntariado</h3>
                <p>O voluntariado é a força vital que impulsiona o nosso trabalho no canil e gatil municipal. São os
                    nossos voluntários que, com dedicação e amor, transformam a vida dos cães e gatos que acolhemos,
                    proporcionando-lhes cuidado, atenção e carinho em cada momento.</p>
                </p>
                <p>
                    Os nossos voluntários desempenham um papel fundamental em diversas áreas, desde a alimentação e
                    cuidados diários dos animais, até à organização de eventos de adoção, campanhas de sensibilização
                    e angariação de fundos. Cada gesto, por mais pequeno que seja, tem um impacto enorme na vida dos
                    nossos amigos de quatro patas.</p>
                </p>
                <p>
                    Se tem um coração cheio de amor pelos animais e deseja fazer a diferença, junte-se a nós como
                    voluntário. O seu tempo e dedicação serão recompensados com a alegria de ver um animal que
                    antes estava sozinho e desamparado, florescer sob os seus cuidados e encontrar um lar cheio de
                    amor.</p>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-2">
                <img src="images/volunteerImg.jpg" class="img-fluid rounded shadow" alt="Batalha Landscape">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="section-title">Como se tornar um voluntário</h3>
                <p>Tornar-se um voluntário é simples e gratificante. Basta entrar em contacto connosco através do
                    nosso formulário de contacto ou visitar-nos pessoalmente para saber mais sobre as oportunidades de
                    voluntariado disponíveis. Estamos sempre à procura de pessoas apaixonadas e dedicadas para se
                    juntarem à nossa equipa e fazerem a diferença na vida dos nossos animais.</p>
                </p>

                <p>
                    <strong>Para se voluntariar, preencha o nosso formulário de inscrição ou contacte-nos através do
                        nosso email
                        ou telefone.</strong>
                </p>
                <a href="/form-volunteer" class="btn btn-orange">Formulario de voluntariado</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">Como se tornar uma FAT (Família de Acolhimento Temporário)</h3>
                <p>
                    Se não pode adotar um animal de forma permanente, pode ainda assim mudar uma vida. O acolhimento
                    temporário é, muitas vezes, a diferença entre um animal continuar preso num canil ou ter finalmente
                    a oportunidade de recuperar, ganhar confiança e encontrar uma família definitiva.
                </p>
                <p>
                    Ao abrir temporariamente as portas da sua casa, está a oferecer algo que nenhum abrigo consegue
                    substituir: atenção, estabilidade e carinho. Esse tempo pode ser fundamental para que o animal
                    recupere física e emocionalmente e tenha uma verdadeira segunda oportunidade.
                </p>
                <p>
                    Registar-se na nossa base de dados não implica qualquer compromisso permanente. Encaramos a
                    inscrição apenas como uma demonstração de disponibilidade para ajudar quando for possível. Quando
                    surgir um caso compatível consigo, entraremos em contacto — e poderá decidir se pode acolher nesse
                    momento.
                </p>
                <p>
                    Ser uma FAT (Família de Acolhimento Temporário) é um gesto simples que pode ter um impacto enorme na
                    vida de um animal. Se tem um pouco de espaço, tempo e vontade de ajudar, pode ser exatamente a
                    pessoa que fará a diferença.
                </p>

                <p>
                    <strong>Para se voluntariar, preencha o nosso formulário de inscrição ou contacte-nos através do
                        nosso email
                        ou telefone.</strong>
                </p>


                <a href="/form-fat" class="btn btn-orange">Formulario FAT</a>
            </div>
        </div>
    </div>
</section>
@endsection