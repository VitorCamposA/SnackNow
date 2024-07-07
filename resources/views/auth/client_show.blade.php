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
                        <p><strong>Endereço: </strong>{{ $supplier['address'] }}</p>
                        <p><strong>Telefone: </strong> {{ $supplier['phone'] }}</p>
                        <p><strong>Email:</strong>  {{ $supplier['email'] }}</p>
                        <p><strong>Especialidade:</strong>  {{ $supplier['specialty'] }}</p>
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
                    <h2>Menu</h2>
                        <p>Nosso menu inclui uma variedade de pratos deliciosos, desde entradas até sobremesas. Venha nos visitar para experimentar!</p>
                        <a href="#" class="btn btn-primary">Ver Menu Completo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
    @if(\App\Models\User::isClient())
        <h2>Add a Comment</h2>
        <form action="{{ route('comments.store', $supplier['id']) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="author">{{\App\Models\User::getCurrentUserData('name')}}</label>
                <input type="hidden" class="form-control" id="author" name="author" value="{{\App\Models\User::getCurrentUserData('name')}}">
            </div>
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    @endif
    <h2>Comments</h2>
    @foreach(\App\Models\Comment::where('user_id', $supplier['id'])->get() as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->author }}</h5>
                <p class="card-text">{{ $comment->content }}</p>
            </div>
        </div>
    @endforeach
        </div>
    </div>
@endsection
