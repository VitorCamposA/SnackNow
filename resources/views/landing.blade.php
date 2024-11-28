@extends('layouts.primary')

@section('title')
    Home
@endsection

@section('content')

<style>
    .landing-page #section-planos .content-cards a{
        text-align: center;
    border: none;
    outline: none;
    color: #212529;
    margin-top: 30px;
    padding: 10px;

    font-weight: 600;
    background-color: #ffb703;
    border-radius: 10px;
    cursor: pointer;

    transition: all 0.3s ease;
}

.landing-page #section-planos .content-cards a:hover{
    background-color: #ffc93f;
}
</style>
    <div class="landing-page">
        <section id="section-home">
            <div class="content-title">
                <h1>Encontre Restaurantes Incríveis Perto de Você</h1>
                <p>Descubra delícias gastronômicas ao seu alcance.</p>
            </div>
            <div class="content-cards">
                <div>
                    <h2>Explore a Cena Local</h2>
                        <p>Encontre uma variedade de restaurantes fantásticos próximos a você. Seja qual for o seu gosto, temos algo especial esperando por você.</p>
                </div>
                <div>
                    <h2>Destaques Exclusivos</h2>
                        <p>Conheça mais sobre cada restaurante, suas especialidades e promoções exclusivas. Nosso projeto destaca o que há de melhor na sua região.</p>
                </div>
                <div>
                    <h2>Junte-se à Nossa Comunidade</h2>
                        <p>Faça parte de uma comunidade de amantes da boa comida. Receba dicas, avaliações e fique por dentro das últimas novidades gastronômicas.</p>
                </div>
            </div>
        </section>

        <section id="section-features">
            <h1>Features</h1>
            <div class="content-cards">
                <div>
                    <h2>Serviços para Clientes</h2>
                    <p>Serviços fornecidos aos clientes que desejam conhecer mais restaurantes, descobrir novos alimentos que gostam ou encontrar um local para eventos especiais, como um encontro ou aniversário.</p>
                </div>
                <div>
                    <h2>Serviços para Parceiros </h2>
                    <p>Serviços fornecidos aos proprietários de restaurantes que desejam expandir seus negócios e encontrar clientes que apreciem seu estilo de comida.</p>
                </div>
            </div>
        </section>

        <section id="section-planos">
            <div class="content-cards">
                <div>
                    <h2>Plano Free</h2>
                    <h3>R$0,00/mês</h3>
                    <p>Ter acesso à buscas de novos restaurantes</p>
                    <a class="btn btn-primary" href="{{route('register-client')}}">Faça sua conta</a>
                </div>
                <div>
                    <h2>Plano Básico Restaurante</h2>
                    <h3>R$20/mês</h3>
                    <p>Acesso ao sistema</p>
                    <button disabled>Garantir Plano</button>
                </div>
                <div>
                    <h2>Plano Premium</h2>
                    <h3>R$30/mês</h3>
                    <p>Acesso aos cupons de até 50% de desconto</p>
                    <button disabled>Garantir Plano</button>
                </div>
            </div>
        </section>

        <section id="section-contact">
            <h1>Contate-nos</h1>
            <div class="content-form">
                <div class="form">
                    <div>
                        <label for="name">Nome</label>
                        <input type="text" id="name">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email">
                    </div>
                    <div>
                        <label for="message">Mensagem</label>
                        <textarea id="message"></textarea>
                    </div>
                </div>
                <button>Enviar</button>
            </div>
        </section>
    </div>
@endsection
