@extends('layouts.primary')

@section('title')
    Welcome!
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center text-white">
                <h1>Encontre Restaurantes Incríveis Perto de Você</h1>
                <p class="lead">Descubra delícias gastronômicas ao seu alcance.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 text-white">
                <h3>Explore a Cena Local</h3>
                <p>Encontre uma variedade de restaurantes fantásticos próximos a você. Seja qual for o seu gosto, temos algo especial esperando por você.</p>
            </div>
            <div class="col-md-4 text-white">
                <h3>Destaques Exclusivos</h3>
                <p>Conheça mais sobre cada restaurante, suas especialidades e promoções exclusivas. Nosso projeto destaca o que há de melhor na sua região.</p>
            </div>
            <div class="col-md-4 text-white">
                <h3>Junte-se à Nossa Comunidade</h3>
                <p>Faça parte de uma comunidade de amantes da boa comida. Receba dicas, avaliações e fique por dentro das últimas novidades gastronômicas.</p>
            </div>
        </div>

    </div>

<section id="features" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Features</h2>
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Service for Clients</h5>
                        <p class="card-text">Services provided to clients who wants to get to know more restaurants, discover more foods they enjoy, or find a place for a special event like a date or birthday</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Service for Suppliers</h5>
                        <p class="card-text">Services provided to restaurants owners who want to expand their business and search clients who likes your food style. Display</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="pricing" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Pricing</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Basic Plan</h5>
                        <p class="card-text">$10/month</p>
                        <ul class="list-unstyled">
                            <li>Feature A</li>
                            <li>Feature B</li>
                            <li>Feature C</li>
                        </ul>
                        <a href="#" class="btn btn-primary">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Standard Plan</h5>
                        <p class="card-text">$20/month</p>
                        <ul class="list-unstyled">
                            <li>Feature A</li>
                            <li>Feature B</li>
                            <li>Feature C</li>
                        </ul>
                        <a href="#" class="btn btn-primary">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Premium Plan</h5>
                        <p class="card-text">$30/month</p>
                        <ul class="list-unstyled">
                            <li>Feature A</li>
                            <li>Feature B</li>
                            <li>Feature C</li>
                        </ul>
                        <a href="#" class="btn btn-primary">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Contact Us</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
