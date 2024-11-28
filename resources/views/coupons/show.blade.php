@extends('layouts.primary')
@section('title')
    Meus Cupons
@endsection
@section('content')
    <div class="container" style="min-height: 84vh;">
        <h1 class="mb-4 text-white">Meus cupons</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-dark table-bordered table-striped">
            <thead>
            <tr>
                <th>Código do Cupom</th>
                <th>Restaurante</th>
                <th>Porcentagem do Desconto</th>
                <th>Válido até</th>
            </tr>
            </thead>
            <tbody>
            @forelse($couponsArray as $coupon)
                <tr>
                    <td>{{ $coupon['code'] }}</td>
                    <td>{{ $coupon['name'] }}</td>
                    <td>{{ $coupon['percentage'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon['until'])->format('d/m/y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Nenhum cupom encontrado</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
