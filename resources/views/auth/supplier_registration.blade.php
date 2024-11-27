@extends('layouts.primary')

@section('title')
    Register
@endsection

@section('content')
    <main class="signup-form row justify-content-center mt-5" style="min-height: 79vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-white" style="background-color: #343A40">
                        <h3 class="card-header text-center">Registro de Resturante Parceiro</h3>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="registrationTabs" role="tablist">
                                <li class="nav-item">
                                    <span class="nav-link active" id="personal-tab" role="tab" aria-controls="personal" aria-selected="true" style="cursor: pointer;">Informação</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="contact-tab" role="tab" aria-controls="contact" aria-selected="false" style="cursor: pointer;">Informação de Contato</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="business-tab" role="tab" aria-controls="business" aria-selected="false" style="cursor: pointer;">Informação do negócio</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="password-tab" role="tab" aria-controls="password" aria-selected="false" style="cursor: pointer;">Senha</span>
                                </li>
                            </ul>
                            <form id="registrationForm" action="{{ route('store-supplier') }}" method="post">
                                @csrf
                                <div class="form-step form-step-active" data-title="Personal Info">
                                    <div class="my-3 row">
                                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nome</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <button type="button" class="btn btn-primary next-step">Próximo</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Contact Info">
                                    <div class="my-3 row">
                                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-end text-start">Telefone</label>
                                        <div class="col-md-6">
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" maxlength="15" name="phone" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row d-grid gap-3">
                                        <button type="button" class="btn btn-primary next-step">Próximo</button>
                                        <button type="button" class="btn btn-secondary prev-step">Voltar</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Business Info">
                                    <div class="my-3 row">
                                        <label for="cep" class="col-md-4 col-form-label text-md-end text-start">CEP</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" maxlength="9" value="{{ old('cep') }}" placeholder="Digite o CEP">
                                            <span class="text-danger" id="cep-error"></span>
                                        </div>
                                    </div>
                                    <div class="my-3 row">
                                        <label for="address" class="col-md-4 col-form-label text-md-end text-start">Endereço</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" readonly>
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="my-3 row">
                                        <label for="number" class="col-md-4 col-form-label text-md-end text-start">Número</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}">
                                            @if ($errors->has('number'))
                                                <span class="text-danger">{{ $errors->first('number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="my-3 row">
                                        <label for="complement" class="col-md-4 col-form-label text-md-end text-start">Complemento</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('complement') is-invalid @enderror" placeholder="(Opcional)" id="complement" name="complement" value="{{ old('complement') }}">
                                            @error('complement')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="specialty" class="col-md-4 col-form-label text-md-end text-start">Especialidade</label>
                                        <div class="col-md-6">
                                            <select class="form-control @error('specialty') is-invalid @enderror" id="specialty" name="specialty">
                                                <option value=""></option>
                                                <option value="Fast Food" {{ old('specialty') == 'Fast Food' ? 'selected' : '' }}>Fast Food</option>
                                                <option value="Desserts" {{ old('specialty') == 'Desserts' ? 'selected' : '' }}>Sobremesa</option>
                                                <option value="Pasta" {{ old('specialty') == 'Desserts' ? 'selected' : '' }}>Massa</option>
                                                <option value="Seafood" {{ old('specialty') == 'Seafood' ? 'selected' : '' }}>Comida Marítima</option>
                                                <option value="Barbecue" {{ old('specialty') == 'Barbecue' ? 'selected' : '' }}>Barbecue</option>
                                                <option value="Brazilian" {{ old('specialty') == 'Brazilian' ? 'selected' : '' }}>Comida Brasileira</option>
                                                <option value="Korean" {{ old('specialty') == 'Korean' ? 'selected' : '' }}>Comida Coreana</option>
                                                <option value="Mexican" {{ old('specialty') == 'Mexican' ? 'selected' : '' }}>Comida Mexicana</option>
                                                <option value="Italian" {{ old('specialty') == 'Italian' ? 'selected' : '' }}>Comida Italiana</option>
                                                <option value="Chinese" {{ old('specialty') == 'Chinese' ? 'selected' : '' }}>Comida Chinesa</option>
                                                <option value="Japanese" {{ old('specialty') == 'Japanese' ? 'selected' : '' }}>Comida Japonesa</option>
                                            </select>
                                            @if ($errors->has('specialty'))
                                                <span class="text-danger">{{ $errors->first('specialty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row d-grid gap-3">
                                        <button type="button" class="btn btn-primary next-step">Próximo</button>
                                        <button type="button" class="btn btn-secondary prev-step">Voltar</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Password">
                                    <div class="my-3 row">
                                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Senha</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirmar Senha</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="mb-3 row d-grid gap-3">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                        <button type="button" class="btn btn-secondary prev-step">Voltar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
       document.addEventListener('DOMContentLoaded', function() {
        const steps = document.querySelectorAll('.form-step');
        const tabs = document.querySelectorAll('#registrationTabs .nav-link');

        function showStep(index) {
            steps.forEach((step, stepIndex) => {
                step.style.display = stepIndex === index ? 'block' : 'none';
            });
            tabs.forEach((tab, tabIndex) => {
                tab.classList.toggle('active', tabIndex === index);
            });
        }

        steps.forEach((step, index) => {
            if (index !== 0) {
                step.style.display = 'none';
            }
        });

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                showStep(index);
            });
        });

        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');

        nextButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                showStep(index + 1);
            });
        });

        prevButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                showStep(index);
            });
        });

        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', function (e) {
            let value = e.target.value;

            const isDeleting = e.inputType === 'deleteContentBackward';

            value = value.replace(/\D/g, '');

            if (value.length <= 10) {
                value = value.replace(/(\d{0,2})(\d{0,4})(\d{0,4})/, function (_, ddd, part1, part2) {
                    return isDeleting && value.length <= 2
                        ? part1
                        : `${ddd ? `(${ddd}) ` : ''}${part1}${part2 ? '-' + part2 : ''}`;
                });
            } else {
                value = value.replace(/(\d{0,2})(\d{0,5})(\d{0,4})/, function (_, ddd, part1, part2) {
                    return isDeleting && value.length <= 2
                        ? part1
                        : `${ddd ? `(${ddd}) ` : ''}${part1}-${part2}`;
                });
            }
            e.target.value = value;
        });
           const cepInput = document.getElementById('cep');
           const addressInput = document.getElementById('address');
           const cepError = document.getElementById('cep-error');

           // Máscara para CEP
           cepInput.addEventListener('input', function(e) {
               let value = e.target.value.replace(/\D/g, '');
               value = value.replace(/^(\d{5})(\d{1,3})/, '$1-$2');
               e.target.value = value;
           });

           // Busca automática de endereço via ViaCEP
           cepInput.addEventListener('blur', function() {
               const cep = cepInput.value.replace(/\D/g, '');
               if (cep.length === 8) {
                   fetch(`https://viacep.com.br/ws/${cep}/json/`)
                       .then(res => res.json())
                       .then(data => {
                           if (data.erro) throw new Error('CEP não encontrado');
                           addressInput.value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                           cepError.textContent = '';
                       })
                       .catch(err => {
                           addressInput.value = '';
                           cepError.textContent = err.message;
                       });
               } else {
                   cepError.textContent = 'CEP inválido.';
               }
           });
    });

    </script>
@endsection
