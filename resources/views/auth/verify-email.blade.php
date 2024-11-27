@extends('layouts.primary')

@section('title')
    Verifique seu E-Mail
@endsection

@section('content')
    <div class="container my-3" style="min-height: 79vh;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifique o seu e-mail') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Antes de prosseguir, por favor cheque seu email para a verificação.') }}
                        {{ __('Se você não recebeu nenhum e-mail,') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para reenviar') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
