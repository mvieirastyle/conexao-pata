@extends('layouts.default')

@section('content')
<section class="py-5 bg-orange text-white header-small"
    style="background-image: -moz-linear-gradient( #e26600c2, #fc860093), url('images/DonateImg.jpg'); background-size: cover; background-position: center;">
    <div class="container text-center">
        <h1 class="display-4">Doar</h1>
        <p class="lead">Ajude nos a dar a estes animais uma segunda oportunidade</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 mx-auto">
                <h3 class="section-title">Doar</h3>
                <p>Todos os dias, cães e gatos chegam ao canil e gatil municipal à procura de algo simples, mas
                    essencial: cuidado, proteção e uma nova oportunidade de serem felizes. Muitos deles foram
                    abandonados, outros perderam-se das suas famílias, e alguns nunca conheceram o carinho de um lar.
                </p>
                <p>As doações fazem uma enorme diferença. Com o seu contributo conseguimos garantir ração, medicamentos,
                    vacinas, tratamentos veterinários, mantas, limpeza das instalações e melhores condições para todos
                    os animais que acolhemos.Aqui, cada animal recebe abrigo, alimentação, acompanhamento veterinário e,
                    acima de tudo, atenção e
                    respeito. Mas para que possamos continuar este trabalho, precisamos da ajuda da comunidade.</p>

                <p>Mesmo um pequeno gesto pode transformar a vida de um animal que já passou por tanto. A sua ajuda
                    significa mais conforto, mais saúde e mais esperança para cães e gatos que aguardam pacientemente
                    por um novo começo.</p>

                <p>Se puder, contribua. Cada doação é um passo mais perto de proporcionar uma vida digna e segura a quem
                    não tem voz para pedir ajuda.</p>

                <p><strong>Doe. Apoie. Partilhe.</strong>
                    Juntos, podemos oferecer cuidado, proteção e a possibilidade de um futuro melhor a estes animais.
                </p>

            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-2">
                <img src="images/DonateDog.jpg" class="img-fluid rounded shadow"
                    alt="Batalha Landscape">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="section-title">Como Doar</h3>
                <p>
                    Todo o dinheiro angariado é utilizado exclusivamente em benefício dos animais ao nosso cuidado. A
                    sua ajuda permite garantir alimentação, tratamentos veterinários, medicamentos e melhores condições
                    de vida para cães e gatos que aguardam por uma nova oportunidade.
                </p>

                <p>Pode apoiar-nos através das seguintes formas:</p>

                <h5 style="color: #0ebb56">
                    <i class="fa-solid fa-hand-holding-medical" style="color: #e67e22;"></i>
                    <strong>Donativos em género</strong>
                </h5>

                <p>São sempre bem-vindos materiais que nos ajudam no dia-a-dia do canil e gatil, tais como:</p>

                <ul style="list-style: none; padding-left: 0;">
                    <li><i class="fa-solid fa-bone" style="color: #e67e22;"></i> Comida seca e comida húmida (latas)
                        para cães e gatos</li>
                    <li><i class="fa-solid fa-bug-slash" style="color: #e67e22;"></i> Coleiras desparasitantes</li>
                    <li><i class="fa-solid fa-microchip" style="color: #e67e22;"></i> Leitores de microchip</li>
                    <li><i class="fa-solid fa-dog" style="color: #e67e22;"></i> Trelas, coleiras e peitorais</li>
                    <li><i class="fa-solid fa-pills" style="color: #e67e22;"></i> Medicamentos veterinários</li>
                    <li><i class="fa-solid fa-broom" style="color: #e67e22;"></i> Produtos de limpeza (detergentes, pás,
                        vassouras, entre outros)</li>
                    <li><i class="fa-solid fa-cat" style="color: #e67e22;"></i> Areia para gatos</li>
                    <li><i class="fa-solid fa-house" style="color: #e67e22;"></i> Casotas de plástico e camas para
                        animais</li>
                </ul>

                <p>
                    Pode também consultar a <strong>lista atual de necessidades</strong> e os
                    <strong>medicamentos mais utilizados</strong> para saber quais são os artigos
                    mais urgentes neste momento.
                </p>

                <h5 style="color: #0ebb56">
                    <i class="fa-solid fa-hand-holding-dollar" style="color: #e67e22;"></i> <strong>Donativos
                        monetários</strong>
                </h5>

                <p>
                    Também pode contribuir através de donativos financeiros, que nos permitem responder rapidamente às
                    necessidades mais urgentes dos animais.
                </p>

                <ul style="list-style: none; padding-left: 0;">
                    <li><i class="fa-brands fa-paypal" style="color: #e67e22;"></i> <strong>PayPal</strong> – através da
                        nossa página de donativos</li>
                    <li><i class="fa-solid fa-wallet" style="color: #e67e22;"></i> <strong>MBWAY</strong> – +351 912 345 678</li>
                    <li><i class="fa-solid fa-university" style="color: #e67e22;"></i> <strong>Transferência
                            bancária</strong> – através do nosso IBAN: PT50 0002 0123 12345678901 23</li>

            </div>
        </div>
    </div>
</section>
@endsection