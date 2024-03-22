@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="myForm">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Nome Utente') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Indirizzo E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- NOME RISTORANTE --}}
                            <div class="mb-4 row">
                                <label for="restaurant_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Nome ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="restaurant_name" type="name"
                                        class="form-control @error('restaurant_name') is-invalid @enderror"
                                        name="restaurant_name" required autocomplete="restaurant_name">

                                    @error('restaurant_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- INDIRIZZO RISTORANTE --}}
                            <div class="mb-4 row">
                                <label for="restaurant_address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*Indirizzo ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="restaurant_address" type="name"
                                        class="form-control @error('restaurant_address') is-invalid @enderror"
                                        name="restaurant_address" required autocomplete="restaurant_address">

                                    @error('restaurant_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- PIVA RISTORANTE --}}
                            <div class="mb-4 row">
                                <label for="piva"
                                    class="col-md-4 col-form-label text-md-right">{{ __('*P.IVA') }}</label>
                                <div class="col-md-6">
                                    <input id="piva" type="text"
                                        class="form-control @error('piva') is-invalid @enderror" name="piva" required
                                        autocomplete="piva">
                                    <div id="pivaError" style="color: red; display: none;"></div>
                                    @error('piva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="pivaError" style="display:none"></div>
                                </div>
                            </div>

                            <script>
                                document.getElementById("myForm").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Previeni l'invio del modulo predefinito

                                    let counter = 0;

                                    let pivaValue = document.getElementById("piva").value;
                                    let img = document.getElementById("image");

                                    counter = counter + checkPiva(pivaValue, counter);
                                    counter = counter + checkImage(img, counter);
                                    if (counter === 2) {
                                        this.submit();
                                    }
                                });

                                function checkPiva(pivaValue, counter) {
                                    counter = 0;
                                    if (!isNaN(pivaValue) && pivaValue.length === 11) {
                                        document.getElementById("pivaError").style.display = "none";
                                        counter++;
                                    } else {
                                        document.getElementById("pivaError").style.display = "block";
                                        document.getElementById("pivaError").innerHTML = "La P.IVA deve essere composta da 11 cifre numeriche.";
                                    }
                                    return counter;
                                }
                            </script>

                            {{-- VISIBILITA' RISTORANTE --}}
                            {{-- <div class="mb-4 row">
                                <label for="visible"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Visibilità') }}</label>
                                <div class="offset-md-10 "></div>
                                <div class="col-md-1">
                                    <input id="visible" type="checkbox"
                                        class="form-control @error('visible') is-invalid @enderror" name="visible"
                                        value="1" autocomplete="visible" checked>
                                    @error('visible')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}


                            {{-- IMMAGINE DEL RISTORANTE --}}
                            <div class="mb-4 row">
                                <span class="d-block">Tipo di file (jpg, png, jpeg): </span>
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Immagine del Ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" name="image">

                                    <div id="imageError" style="color: red; display: none;"></div>
                                </div>
                            </div>

                            <script>
                                function checkImage(img, counter) {
                                    // Se seleziono un file
                                    if (img.files.length > 0) {
                                        counter = 0;

                                        // File selezionato
                                        let file = img.files[0];

                                        // Verifica del tipo di file
                                        if (file.type.includes('image/jpeg') || file.type.includes('image/png') || file.type.includes(
                                                'image/jpg')) {
                                            // Verifica se la dimensione del file è inferiore a 2 MB
                                            if (file.size <= 2048 * 1024) {
                                                document.getElementById("imageError").style.display = "none";
                                                counter++;
                                            } else {
                                                document.getElementById("imageError").style.display = "block";
                                                document.getElementById("imageError").innerHTML = "Dimensione del file superiore a 2MB";
                                            }
                                        } else {
                                            document.getElementById("imageError").style.display = "block";
                                            document.getElementById("imageError").innerHTML = "Formato non supportato";
                                        }
                                    } else {
                                        // Nascondi il messaggio di errore se l'utente non ha selezionato un'immagine
                                        document.getElementById("imageError").style.display = "none";
                                    }

                                    return counter;
                                };

                                //creiamo con un evento che viene attivato solo quando la pagina è completamente carica
                                document.addEventListener('DOMContentLoaded', function () {

                                    //prendo le due password tramite dei getElementById 
                                    var firstPassword = document.getElementById('password');
                                    var confirmPassword = document.getElementById('password-confirm');

                                    //creo una funzione dove dico che se la password è uguale lascio scorrere ma se è sbagliata 
                                    //faccio apparire un messaggio
                                    function passwordValid(){
                                        if (firstPassword.value === confirmPassword.value) {
                                            confirmPassword.setCustomValidity('');
                                        } else {
                                            confirmPassword.setCustomValidity("Le password non corrispondono");
                                        }
                                    }

                                    //infine qui richiamo le due funzioni e le metto a confronto
                                    firstPassword.addEventListener('change', passwordValid);
                                    confirmPassword.addEventListener('keyup', passwordValid);
                                });

                                //creiamo una funzione dove hai la possibilità di selezionare massimo due tipologie
                                function limitTipologies() {
                                    
                                    //ci ricaviamo solo gli input selezionati
                                    var checkbox = document.querySelectorAll('input[name="tipologie[]"]:checked');

                                    //e gli diciamo che se la lunghezza dei checkbox selezionati supera 2
                                    if (checkbox.length > 2) {

                                        //fai apparire questo alert
                                        document.getElementById("tipologyError").innerHTML = "Puoi selezionare solo 2 tipologie";

                                        //e da qui preveniamo l'invio del modulo
                                        event.preventDefault();
                                    }
                                }
                            </script>

                            {{-- TIPOLOGIE RISTORANTE --}}
                            <div>
                                <label>Tipologie:</label><br>

                                @foreach ($tipologies as $tipologia)
                                    <input type="checkbox" id="tipologia{{ $tipologia->id }}" name="tipologie[]"
                                        value="{{ $tipologia->id }}" onclick="limitTipologies()">
                                    <label for="tipologia{{ $tipologia->id }}">{{ $tipologia->name }}</label><br>
                                @endforeach
                                
                                <div id="tipologyError" style="color: red;"></div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>

                            <small>I campi contrassegnati con * sono <b>obbligatori</b>!</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
