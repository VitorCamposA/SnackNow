@extends('layouts.primary')

@section('title')
    Register
@endsection

@section('content')
    <main class="signup-form row justify-content-center mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-white" style="background-color: #343A40">
                        <h3 class="card-header text-center">Supplier Register</h3>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="registrationTabs" role="tablist">
                                <li class="nav-item">
                                    <span class="nav-link active" id="personal-tab" role="tab" aria-controls="personal" aria-selected="true">Personal Info</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="contact-tab" role="tab" aria-controls="contact" aria-selected="false">Contact Info</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="business-tab" role="tab" aria-controls="business" aria-selected="false">Business Info</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link" id="password-tab" role="tab" aria-controls="password" aria-selected="false">Password</span>
                                </li>
                            </ul>
                            <form id="registrationForm" action="{{ route('store-supplier') }}" method="post">
                                @csrf
                                <div class="form-step form-step-active" data-title="Personal Info">
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
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Contact Info">
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
                                        <label for="phone" class="col-md-4 col-form-label text-md-end text-start">Phone</label>
                                        <div class="col-md-6">
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Business Info">
                                    <div class="mb-3 row">
                                        <label for="address" class="col-md-4 col-form-label text-md-end text-start">Address</label>
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
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </div>
                                </div>
                                <div class="form-step" data-title="Password">
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
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="submit" class="btn btn-primary">Register</button>
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
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            const tabs = document.querySelectorAll('#registrationTabs .nav-link');

            function validateStep(step) {
                const inputs = step.querySelectorAll('input, select');
                for (let input of inputs) {
                    if (!input.value) {
                        return false;
                    }
                }
                return true;
            }

            steps.forEach((step, index) => {
                if (index !== 0) {
                    step.style.display = 'none';
                }
            });

            nextButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    if (validateStep(steps[index])) {
                        steps[index].style.display = 'none';
                        steps[index + 1].style.display = 'block';
                        tabs[index].classList.remove('active');
                        tabs[index + 1].classList.add('active');
                    } else {
                        alert('Please fill all fields before proceeding.');
                    }
                });
            });

            prevButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    steps[index + 1].style.display = 'none';
                    steps[index].style.display = 'block';
                    tabs[index + 1].classList.remove('active');
                    tabs[index].classList.add('active');
                });
            });
        });
    </script>
@endsection
