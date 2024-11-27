@extends('layouts.primary')
@section('title')
    Criar Cupom
@endsection
@section('content')
    <div class="container text-white my-5" style="min-height: 79vh">
        <h1>Criar Cupom</h1>
        <form method="POST" action="{{ route('coupons.store') }}">
            @csrf
            <div class="form-group">
                <label for="code">Código do cupom</label>
                <input type="text" name="code" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="discount_amount">Valor máximo de Desconto</label>
                <input type="number" name="discount_amount" class="form-control bg-dark text-light">
            </div>
            <div class="form-group">
                <label for="discount_percentage">Porcentagem do Desconto</label>
                <input type="number" name="discount_percentage" class="form-control bg-dark text-light">
            </div>
            <div class="form-group">
                <label for="valid_from">Válido a Partir De</label>
                <input type="date" name="valid_from" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="valid_until">Válido até</label>
                <input type="date" name="valid_until" class="form-control bg-dark text-light" required>
            </div>
            <div class="form-group">
                <label for="minimum_visits">Mínimo de Visitas</label>
                <div class="input-group">
                    <input type="number" name="minimum_visits" id="minimum_visits" class="form-control bg-dark text-light">
                    <div class="input-group-append">
                        <div class="input-group-text bg-dark text-light">
                            <input type="checkbox" id="no_minimum_visits">
                            <label for="no_minimum_visits" class="mb-0 ml-2">Sem mínimo de visitas</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-3">Criar Cupom</button>
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
    </script>
@endsection
