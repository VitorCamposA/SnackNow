@extends('layouts.primary')

@section('title')
    Register
@endsection

@section('content')
    <main class="signup-form row justify-content-center mt-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-white" style="background-color: #343A40">
                        <h3 class="card-header text-center">Supplier Register</h3>
                        <div class="card-body">
                    <form action="{{ route('store-supplier') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Phone</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const cellphoneInput = document.getElementById('phone');

                                cellphoneInput.addEventListener('input', function(e) {
                                    let input = e.target.value;
                                    input = input.replace(/\D/g, ''); // Remove tudo que não é dígito

                                    if (input.length > 0) {
                                        input = `(${input.substring(0, 2)}) ${input.substring(2)}`;
                                    }
                                    if (input.length > 10) {
                                        input = `${input.substring(0, 10)}-${input.substring(10, 14)}`;
                                    }
                                    e.target.value = input;
                                });
                            });
                        </script>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="specialty" class="col-md-4 col-form-label text-md-end text-start">Specialty</label>
                            <div class="col-md-6">
                                <select class="form-control @error('specialty') is-invalid @enderror" id="specialty" name="specialty">
                                    <option value=""></option>
                                    <option value="Fast Food" {{ old('specialty') == 'Fast Food' ? 'selected' : '' }}>Fast Food</option>
                                    <option value="Desserts" {{ old('specialty') == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                                    <option value="Seafood" {{ old('specialty') == 'Seafood' ? 'selected' : '' }}>Seafood</option>
                                    <option value="Barbecue" {{ old('specialty') == 'Barbecue' ? 'selected' : '' }}>Barbecue</option>
                                    <option value="Brazilian" {{ old('specialty') == 'Brazilian' ? 'selected' : '' }}>Brazilian</option>
                                    <option value="Korean" {{ old('specialty') == 'Korean' ? 'selected' : '' }}>Korean</option>
                                    <option value="Mexican" {{ old('specialty') == 'Mexican' ? 'selected' : '' }}>Mexican</option>
                                    <option value="Italian" {{ old('specialty') == 'Italian' ? 'selected' : '' }}>Italian</option>
                                    <option value="Chinese" {{ old('specialty') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                    <option value="Japanese" {{ old('specialty') == 'Japanese' ? 'selected' : '' }}>Japanese</option>
                                </select>
                                @if ($errors->has('specialty'))
                                    <span class="text-danger">{{ $errors->first('specialty') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
