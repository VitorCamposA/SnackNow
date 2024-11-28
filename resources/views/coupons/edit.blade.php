@extends('layouts.primary')

@section('title')
    Editar Cupom

@section('content')
    <div class="text-white container my-5" style="min-height: 73vh">
        <h1>Editar Cupom</h1>
        <form method="POST" action="{{ route('coupons.update', $coupon->id) }}" class="d-grid gap-3">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Código do cupom</label>
                <input type="text" name="code" class="form-control bg-dark text-light" value="{{ $coupon->code }}" required>
            </div>

            <div class="form-group">
                <label for="discount_amount">Valor máximo de Desconto</label>
                <input type="number" name="discount_amount" class="form-control bg-dark text-light" value="{{ $coupon->discount_amount }}">
            </div>

            <div class="form-group">
                <label for="discount_percentage">Porcentagem do Desconto</label>
                <input type="number" name="discount_percentage" class="form-control bg-dark text-light" value="{{ $coupon->discount_percentage }}">
            </div>

            <div class="form-group">
                <label for="valid_from">Válido a Partir De</label>
                <input type="date" name="valid_from" class="form-control bg-dark text-light" value="{{ $coupon->valid_from }}" required>
            </div>

            <div class="form-group">
                <label for="valid_until">Válido até</label>
                <input type="date" name="valid_until" class="form-control bg-dark text-light" value="{{ $coupon->valid_until }}" required>
            </div>

            <div class="form-group">
                <label for="minimum_visits">Mínimo de Visitas</label>
                <div class="input-group d-flex align-items-center gap-3">
                    <input type="number" name="minimum_visits" id="minimum_visits" class="form-control bg-dark text-light" value="{{ $coupon->minimum_visits }}">
                    <div class="input-group-append">
                        <div class="input-group-text bg-dark text-light">
                            <input type="checkbox" id="no_minimum_visits" {{ is_null($coupon->minimum_visits) ? 'checked' : '' }}>
                            <label for="no_minimum_visits" class="mb-0 ml-2">Sem mínimo de visitas</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-3">Editar Cupom</button>
        </form>
    </div>

    <script>
        document.getElementById('no_minimum_visits').addEventListener('change', function() {
            const minimumVisitsInput = document.getElementById('minimum_visits');
            if (this.checked) {
                minimumVisitsInput.value = '';
                minimumVisitsInput.disabled = true;
            } else {
                minimumVisitsInput.disabled = false;
            }
        });

        document.getElementById('no_minimum_visits').dispatchEvent(new Event('change'));
    </script>
@endsection
