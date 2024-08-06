@extends('layouts.primary')

@section('title')
    Home Page
@endsection

@section('content')
    <style>
        .star-rating .fa {
            font-size: 1.5em;
            cursor: pointer;
            color: #ddd;
        }
        .star-rating .fa.checked {
            color: #f39c12;
        }
    </style>
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
        <h2 class="text-white">Comentários:</h2>
        <form action="{{ route('comments.store', $supplier['id']) }}" method="POST">
            @csrf
            <div class="card mb-3">
            <div class="card-body bg-secondary">
                <div class="form-group">
                    <h3 for="author">Usuario: {{\App\Models\User::getCurrentUserData('name')}}</h3>
                    <input type="hidden" class="form-control" id="author" name="author" value="{{\App\Models\User::getCurrentUserData('name')}}">
                </div>
                    <div class="form-group">
                        <label for="rating">Nota:</label>
                        <div class="star-rating">
                            <span class="fa fa-star" data-rating="1"></span>
                            <span class="fa fa-star" data-rating="2"></span>
                            <span class="fa fa-star" data-rating="3"></span>
                            <span class="fa fa-star" data-rating="4"></span>
                            <span class="fa fa-star" data-rating="5"></span>
                            <input type="hidden" name="rating" class="rating-value" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content">Comentario:</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Adicionar comentário</button>
        </form>
    @endif
    <h2>Comments</h2>
    @foreach(\App\Models\Comment::where('user_id', $supplier['id'])->get() as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->author }} ({{ str_repeat('★', $comment->rating) }}{{ str_repeat('☆', 5 - $comment->rating) }})</h5>
                <p class="card-text">{{ $comment->content }}</p>
            </div>
        </div>
    @endforeach
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let stars = document.querySelectorAll('.star-rating .fa');
            let ratingInput = document.querySelector('.rating-value');

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    ratingInput.value = index + 1;

                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.add('checked');
                        } else {
                            s.classList.remove('checked');
                        }
                    });
                });
            });
        });
    </script>
@endsection
