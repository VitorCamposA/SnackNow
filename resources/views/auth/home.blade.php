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
    <div class="home" style="min-height: 79vh;">

        <main class="container my-5">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('dashcli') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" name="specialty" id="specialty">
                            <option value="">Todas Especialidades</option>
                            <option value="Fast Food" {{ old('specialty') == 'Fast Food' ? 'selected' : '' }}>Fast Food</option>
                            <option value="Desserts" {{ old('specialty') == 'Desserts' ? 'selected' : '' }}>Sobremesa</option>
                            <option value="Pasta" {{ old('specialty') == 'Desserts' ? 'selected' : '' }}>Massa</option>
                            <option value="Seafood" {{ old('specialty') == 'Seafood' ? 'selected' : '' }}>Comida Marítima</option>
                            <option value="Barbecue" {{ old('specialty') == 'Barbecue' ? 'selected' : '' }}>Churrasco</option>
                            <option value="Brazilian" {{ old('specialty') == 'Brazilian' ? 'selected' : '' }}>Comida Brasileira</option>
                            <option value="Korean" {{ old('specialty') == 'Korean' ? 'selected' : '' }}>Comida Coreana</option>
                            <option value="Mexican" {{ old('specialty') == 'Mexican' ? 'selected' : '' }}>Comida Mexicana</option>
                            <option value="Italian" {{ old('specialty') == 'Italian' ? 'selected' : '' }}>Comida Italiana</option>
                            <option value="Chinese" {{ old('specialty') == 'Chinese' ? 'selected' : '' }}>Comida Chinesa</option>
                            <option value="Japanese" {{ old('specialty') == 'Japanese' ? 'selected' : '' }}>Comida Japonesa</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>

            <div class="row">
                @foreach($suppliers as $supplier)
                    <div class="col-md-6 mb-4">
                        <a href="{{route('show', encrypt($supplier['id']))}}" class="text-decoration-none text-dark">
                            <div class="card h-100 px-3" style="background-color: #343A40">
                                <div class="row no-gutters">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{ $supplier->profile_image ? asset('storage/' . $supplier->profile_image) : "https://triunfo.pe.gov.br/pm_tr430/wp-content/uploads/2018/03/sem-foto.jpg"}}" id="doido" class="card-img" alt="Imagem" style="min-width: 100px; max-width: 300px; min-height: 100px; max-height: 300px;">
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
    </div>

@endsection
