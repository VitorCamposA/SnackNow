@extends('layouts.primary')

@section('title')
    Home Page
@endsection

@section('content')
    <style>
        .card {
            transition: transform 0.5s, box-shadow 0.5s;
        }
        .card:hover {
            transform: translateY(-10px);
            transition: all 0.5s;
            box-shadow: 0 8px 16px #343A50;
        }
        .star-rating .fa {
            font-size: 1.5em;
            cursor: pointer;
            color: #ddd;
        }
        .star-rating .fa.checked {
            color: #f39c12;
        }
    </style>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            @if (session()->has('message'))
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <main class="container my-5">
        <div class="row">
            @foreach(\App\Models\User::where('type_of', 1)->get() as $supplier)
                <div class="col-md-6 mb-4">
                    <a href="{{route('show', encrypt($supplier['id']))}}" class="text-decoration-none text-dark">
                        <div class="card h-100" style="background-color: #343A40">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="https://triunfo.pe.gov.br/pm_tr430/wp-content/uploads/2018/03/sem-foto.jpg" id="doido" class="card-img" alt="Imagem">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-white">
                                        <h5 class="card-title">{{$supplier['name']}}</h5>
                                        <p class="card-text">Endereço: {{$supplier['address']}}</p>
                                        <p class="card-text"><strong>Avaliação: </strong>
                                            @php
                                                $averageRating = $supplier->comments()->avg('rating');
                                                $fullStars = floor($averageRating);
                                                $halfStar = ($averageRating - $fullStars) >= 0.5;
                                            @endphp
                                            <span class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if($i <= $fullStars)
                                                        <span class="fa fa-star checked"></span>
                                                    @elseif($halfStar && $i == $fullStars + 1)
                                                        <span class="fa fa-star-half-alt checked"></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                            </span>
                                        </p>
                                        @if(Auth::user()?->favorites?->contains($supplier['id']))
                                            <form action="{{ route('favorites.remove', $supplier['id']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Remover dos Favoritos</button>
                                            </form>
                                        @else
                                            <form action="{{ route('favorites.add', $supplier['id']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Adicionar aos Favoritos</button>
                                            </form>
                                        @endif
                                        <input hidden value="{{encrypt($supplier['id'])}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
