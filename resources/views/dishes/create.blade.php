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

    <form id="myForm" action="{{ route('dish.store') }}" method="POST" enctype="multipart/form-data"
        class="mt-4 d-flex flex-column justify-content-center align-items-center">
        @csrf
        @method('POST')


        <div class="input">
            <label class="label" for="name">Nome piatto: </label>
            <input type="text" id="name" name="name" class="p-2">
            <div id="nameError" style="color: red; display: none;"></div>
        </div>

        <div class="input">
            <label class="label" for="description">Descrizione piatto: </label>
            <input id="description" type="text" name="description" class="p-2">
            <div id="descriptionError" style="color: red; display: none;"></div>
        </div>

        <div class="input">
            <label class="label" for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="10.20" class="p-2">
            <div id="priceError" style="color: red; display: none;"></div>
        </div>

        <div>
            <span class="d-block">Tipo di file (jpg, png, jpeg): </span>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <div id="imageError" style="color: red; display: none;"></div>
        </div>

        {{-- <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" value="1"> --}}

        <div class="mt-4">
            <input type="submit" value="CREATE">
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
            counter += checkField(priceValue, "priceError", "Compilare questo campo", isNaN(priceValue) || priceValue <= 0);
            counter += checkField(dishName, "nameError", "Compilare questo campo", dishName.trim().length === 0);
            counter += checkField(dishDescription, "descriptionError", "Compilare questo campo", dishDescription.trim().length === 0);
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
                if (file.type.includes('image/jpeg') || file.type.includes('image/png') || file.type.includes('image/jpg')) {
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
    .login {
        padding: 50px;
        width: 477px;
        margin: 20px auto;
    }

    .input {
        margin: 15px 0;
    }

    .label {
        margin-bottom: 5px;
    }

    .button {
        text-align: center;
    }

    button {
        width: 100%;
        height: 40px;
        border-radius: 7px;
        background-color: #E2E5E5;
        margin-bottom: 7px;
    }

    button:hover {
        background-color: #22cdd0;
        color: white;
    }

    input {
        border: 1px solid rgb(195, 192, 192);
        border-radius: 5px;
        height: 40px;
        width: 100%;
    }

    input:focus {
        border-color: #22cdd0;
    }

    a {
        color: #22cdd0;
        margin-left: 3px;
    }
</style>
