@extends('layouts.primary')

@section('title')
    Home Page
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-4" style="background-color: #343A40">
                    <img src="https://triunfo.pe.gov.br/pm_tr430/wp-content/uploads/2018/03/sem-foto.jpg" class="img-fluid" alt="Imagem do Restaurante">
                    <div class="card-body text-white">
                        <h2>{{ $supplier['name'] }}</h2>
                        <br>
                        <p><strong>Endereço: </strong>Endereço: Rua XXXXXXX, n XXX - Bairro XXXXXXX(Pendente no Cadastro)</p>
                        <p><strong>Telefone: </strong> (XX) XXXXX-XXXX</p>
                        <p><strong>Email:</strong>  {{ $supplier['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mt-4" style="background-color: #343A40">
                    <div class="card-body text-white">
                    <h2>Horário de Funcionamento</h2>
                        <p><strong>Segunda a Sexta:</strong> 10:00 - 22:00</p>
                        <p><strong>Sábado:</strong> 11:00 - 23:00</p>
                        <p><strong>Domingo:</strong> Fechado</p>
                    </div>
                </div>
                <div class="card mt-4" style="background-color: #343A40">
                    <div class="card-body text-white">
                    <h2>Especialidades</h2>
                        <p></p>
                        <p>Comida Mediterrânea</p>
                        <p>Churrasco</p>
                        <p>Sushi</p>
                    </div>
                </div>
                <div class="card mt-4" style="background-color: #343A40">
                    <div class="card-body text-white">
                    <h2>Menu</h2>
                        <p>Nosso menu inclui uma variedade de pratos deliciosos, desde entradas até sobremesas. Venha nos visitar para experimentar!</p>
                        <a href="#" class="btn btn-primary">Ver Menu Completo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
