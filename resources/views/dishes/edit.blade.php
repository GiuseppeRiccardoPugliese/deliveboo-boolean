@extends('layouts.app')
@section('content')
    {{-- VALIDATION REQUEST --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card">
            <form id="myForm" action="{{ route('dish.update', $dish->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-4 d-flex flex-column justify-content-center align-items-center">
                @csrf
                @method('PUT')


                <div class="input-group">
                    <label class="label" for="name">Nome: </label>
                    <input id="name" type="text" name="name" class="p-2" value="{{ $dish->name }}">
                    <div id="nameError" style="color: red; display: none;"></div>
                </div>

                <div class="input-group">
                    <label class="label" for="description">Descrizione: </label>
                    <input id="description" type="text" name="description" class="p-2"
                        value="{{ $dish->description }}">
                    <div id="descriptionError" style="color: red; display: none;"></div>
                </div>

                <div class="input-group">
                    <label class="label" for="price">Prezzo: </label>
                    <input id="price" type="text" name="price" placeholder="10.20" class="p-2"
                        value="{{ $dish->price }}">
                    <div id="priceError" style="color: red; display: none;"></div>
                </div>

                <div class="input-group">
                    <label for="image">Immagine: </label>
                    <span class="d-block">Tipo di file (jpg, png, jpeg) </span>
                    <input type="file" name="image" id="image">
                    <div id="imageError" style="color: red; display: none;"></div>
                </div>
                <img id="image_dish" src="{{ asset('storage/' . $dish->image) }}" alt="Immagine Piatto"
                    style="width: 250px">

                <div class="input-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Salva">
                </div>

            </form>

            {{-- VALIDATION CLIENT-SIDE --}}
            <script>
                document.getElementById("myForm").addEventListener("submit", function(event) {
                    event.preventDefault(); // Previeni l'invio del modulo predefinito

                    let counter = 0;

                    // Recupera il valore di input della PIVA
                    let priceValue = document.getElementById("price").value;
                    let dishName = document.getElementById("name").value;
                    let dishDescription = document.getElementById("description").value;
                    let img = document.getElementById("image");

                    // Verifica ogni campo e incrementa il counter se è valido
                    counter += checkField(priceValue, "priceError", "Compilare questo campo", isNaN(priceValue) ||
                        priceValue <= 0);
                    counter += checkField(dishName, "nameError", "Compilare questo campo", dishName.trim().length === 0);
                    counter += checkField(dishDescription, "descriptionError", "Compilare questo campo", dishDescription
                        .trim().length === 0);
                    counter += checkImage(img);

                    // Se ci sono errori di validazione, non inviare il modulo
                    if (counter < 4) {
                        return false;
                    }

                    // Se il counter è uguale al numero di campi + 1 (l'immagine è facoltativa), invia il modulo
                    if (counter === 4 || (counter === 3 && img.files.length === 0)) {
                        this.submit();
                    }
                });

                // Funzione per la validazione dei campi di input
                function checkField(value, errorDivId, errorMessage, isError) {
                    if (isError) {
                        document.getElementById(errorDivId).style.display = "block";
                        document.getElementById(errorDivId).innerHTML = errorMessage;
                        return 0;
                    } else {
                        document.getElementById(errorDivId).style.display = "none";
                        return 1;
                    }
                }

                // Funzione per la validazione dell'immagine
                function checkImage(img) {
                    // Se seleziono un file
                    if (img.files.length > 0) {
                        // File selezionato
                        let file = img.files[0];

                        // Verifica del tipo di file
                        if (file.type.includes('image/jpeg') || file.type.includes('image/png') || file.type.includes(
                            'image/jpg')) {
                            // Verifica se la dimensione del file è inferiore a 2 MB
                            if (file.size <= 2048 * 1024) {
                                document.getElementById("imageError").style.display = "none";
                                return 1; // L'immagine è valida
                            } else {
                                document.getElementById("imageError").style.display = "block";
                                document.getElementById("imageError").innerHTML = "Dimensione del file superiore a 2MB";
                                return 0; // L'immagine non è valida
                            }
                        } else {
                            document.getElementById("imageError").style.display = "block";
                            document.getElementById("imageError").innerHTML = "Formato non supportato";
                            return 0; // L'immagine non è valida
                        }
                    } else {
                        // Nascondi il messaggio di errore se l'utente non ha selezionato un'immagine
                        document.getElementById("imageError").style.display = "none";
                        return 1; // L'immagine è facoltativa, quindi non conta nel counter
                    }
                }
            </script>
        @endsection


        <style lang="scss" scoped>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                transition: 0.3s;
                width: 400px;
                border-radius: 10px;
                margin: auto;
                padding: 20px;
            }

            .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            }

            .container {
                margin-top: 20px;
            }

            .input-group {
                margin-bottom: 15px;
            }

            .input-group label {
                display: block;
                font-weight: bold;
            }

            .input-group input {
                width: 100%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .input-group input[type="checkbox"] {
                width: auto;
                margin-left: 10px;
            }

            .input-group .btn-primary {
                margin-top: 10px;
            }


            .btn {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #0056b3;
            }
        </style>
