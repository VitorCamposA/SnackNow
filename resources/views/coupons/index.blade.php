@extends('layouts.primary')
@section('title')
    Cupons
@endsection
@section('content')
    <div class="container text-white my-3" style='min-height: 79vh;'>
        <h1 class="mb-4">Meus Cupons Criados</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('coupons.create') }}" class="btn btn-primary mb-3">Criar novo cupom</a>

        <!-- Coupons Table -->
        <table class="table table-dark table-bordered table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Valor Descontado</th>
                <th>Porcentagem do Desconto</th>
                <th>Válido a Partir De </th>
                <th>Válido Até</th>
                <th>Usado</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount_amount ? 'R$' . $coupon->discount_amount : '-' }}</td>
                    <td>{{ $coupon->discount_percentage ? $coupon->discount_percentage . '%' : '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->valid_from)->format('d/m/y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->valid_until)->format('d/m/y') }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Delete Button -->
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que quer deletar?');">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Nenhum cupom criado</td>
                </tr>
            @endforelse
            </tbody>
        </table>


        @if($coupons->count() > 0)
            <div class="text-white container">
                <h1>Registrar Visita</h1>
                <form method="POST" action="{{ route('visit.register', encrypt($coupons[0]?->supplier_id)) }}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="email" style="font-size:1.5em;" class="my-2">Email do Cliente:</label>
                        <input type="email" name="email" required class="form-control bg-dark text-light">
                    </div>

                    <button type="submit" class="btn btn-primary my-3">Registrar</button>
                </form>
            </div>
            <div class="text-white container">
                <h1>Usar Cupom</h1>
                <form method="POST" action="{{ route('coupon.use', encrypt($coupons[0]?->supplier_id)) }}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="email" style="font-size:1.5em;" class="my-2">Email do Cliente:</label>
                        <input type="email" name="email" required class="form-control bg-dark text-light">
                        <label for="code" style="font-size:1.5em;" class="my-2">Codigo do Cupom:</label>
                        <input type="text" name="code" required class="form-control bg-dark text-light">
                    </div>

                    <button type="submit" class="btn btn-primary my-3">Registrar Uso</button>
                </form>
            </div>
        @endif
    </div>
@endsection
