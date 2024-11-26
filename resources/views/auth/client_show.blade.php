    @extends('layouts.primary')

    @section('title')
        Home Page
    @endsection

    @section('content')
        <style>
            input.time-input {
                letter-spacing: 2px;
                text-align: center;
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
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-4" style="background-color: #343A40">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : "https://triunfo.pe.gov.br/pm_tr430/wp-content/uploads/2018/03/sem-foto.jpg"}}" class="img-fluid" alt="Imagem do Restaurante">
                        @if($supplier->id == \Illuminate\Support\Facades\Auth::user()->id)
                            <form action="{{ route('supplier.upload.image') }}" method="POST" enctype="multipart/form-data" style="display: inline-block;">
                                @csrf
                                <input type="file" name="image" id="imageInput" style="display: none;" required>

                                <button type="button" class="btn btn-primary" onclick="document.getElementById('imageInput').click();">
                                    <i class="fas fa-upload"></i> Escolher Imagem
                                </button>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Upload
                                </button>
                            </form>
                        @endif
                        <div class="card-body text-white">
                            <h2>{{ $supplier['name'] }}</h2>
                            <br>
                            <p><strong>Endereço: </strong>{{ $supplier['address'] }}</p>
                            <p><strong>Telefone: </strong> {{ $supplier['phone'] }}</p>
                            <p><strong>Email:</strong>  {{ $supplier['email'] }}</p>
                            <p><strong>Especialidade:</strong>  {{ $supplier['specialty'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body text-white">
                        <h2>Horário de Funcionamento</h2>
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp
                        @foreach($days as $day)
                            @php
                                $schedule = \App\Models\Schedule::where('user_id', $supplier->id)
                                    ->where('day', $day)
                                    ->first();
                            @endphp
                            <p><strong>{{ $day }}:</strong> {{ isset($schedule) && $schedule ? $schedule->open_time . ' - ' . $schedule->close_time : 'Closed' }}</p>
                        @endforeach
                    </div>
                    @if($supplier->id == \Illuminate\Support\Facades\Auth::user()->id)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </button>
                    @endif
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('supplier.updateSchedule', $supplier->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Time Periods</h5>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            @endphp
                                            @foreach($days as $day)
                                                @php
                                                    $schedule = \App\Models\Schedule::where('user_id', $supplier->id)
                                                        ->where('day', $day)
                                                        ->first();
                                                @endphp
                                                <div class="form-group">
                                                    <label for="{{ strtolower($day) }}-time">{{ $day }}</label>
                                                    <input type="text" class="form-control time-input" name="schedule[{{ $day }}]"
                                                           id="{{ strtolower($day) }}-time"
                                                           placeholder="HH:MM - HH:MM"
                                                           value="{{ isset($schedule) && $schedule ? $schedule->open_time . ' - ' . $schedule->close_time : '' }}" maxlength="13">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card mt-4" style="background-color: #343A40">
                        <div class="card-body text-white">
                        <h2>Menu</h2>
                            <p>Nosso menu inclui uma variedade de pratos deliciosos, desde entradas até sobremesas. Venha nos visitar para experimentar!</p>
                            <a href="#" class="btn btn-primary">Ver Menu Completo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
        @if(\App\Models\User::isClient())
            <h2 class="text-white">Comentários:</h2>
            <form action="{{ route('comments.store', $supplier['id']) }}" method="POST">
                @csrf
                <div class="card mb-3">
                <div class="card-body bg-secondary">
                    <div class="form-group">
                        <h3 for="author">Usuario: {{\App\Models\User::getCurrentUserData('name')}}</h3>
                        <input type="hidden" class="form-control" id="author" name="author" value="{{\App\Models\User::getCurrentUserData('name')}}">
                    </div>
                        <div class="form-group">
                            <label for="rating">Nota:</label>
                            <div class="star-rating">
                                <span class="fa fa-star" data-rating="1"></span>
                                <span class="fa fa-star" data-rating="2"></span>
                                <span class="fa fa-star" data-rating="3"></span>
                                <span class="fa fa-star" data-rating="4"></span>
                                <span class="fa fa-star" data-rating="5"></span>
                                <input type="hidden" name="rating" class="rating-value" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Comentario:</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Adicionar comentário</button>
            </form>
        @endif
        <h2>Comments</h2>
        @foreach(\App\Models\Comment::where('user_id', $supplier['id'])->get() as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->author }} ({{ str_repeat('★', $comment->rating) }}{{ str_repeat('☆', 5 - $comment->rating) }})</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                let stars = document.querySelectorAll('.star-rating .fa');
                let ratingInput = document.querySelector('.rating-value');

                stars.forEach((star, index) => {
                    star.addEventListener('click', () => {
                        ratingInput.value = index + 1;

                        stars.forEach((s, i) => {
                            if (i <= index) {
                                s.classList.add('checked');
                            } else {
                                s.classList.remove('checked');
                            }
                        });
                    });
                });
            });


            document.addEventListener('DOMContentLoaded', function () {
                const timeInputs = document.querySelectorAll('.time-input');

                timeInputs.forEach(input => {
                    input.addEventListener('input', function () {
                        let value = this.value.replace(/\D/g, ''); // Remove non-digit characters

                        if (value.length >= 4 && value.length <= 10) {
                            value = value.slice(0, 4) + " - " + value.slice(4); // Add the separator for the second time
                        }

                        if (value.length > 2) {
                            value = value.substring(0, 2) + ':' + value.substring(2); // Format first part as HH:MM
                        }

                        if (value.length > 10) {
                            value = value.substring(0, 10) + ':' + value.substring(10); // Format second part as HH:MM
                        }

                        this.value = value;
                    });

                    input.addEventListener('keydown', function (event) {
                        const key = event.key;
                        const value = this.value;

                        // Allow navigation and control keys
                        if (['Backspace', 'ArrowLeft', 'ArrowRight', 'Tab'].indexOf(key) !== -1) {
                            return;
                        }

                        // Prevent non-numeric input except for control keys
                        if (!/\d/.test(key)) {
                            event.preventDefault();
                        }

                        // Prevent input if the length exceeds the time format (13 characters max: "HH:MM - HH:MM")
                        if (value.length >= 13 && ['Backspace', 'Delete'].indexOf(key) === -1) {
                            event.preventDefault();
                        }
                    });
                });
            });
        </script>
        </script>
    @endsection
