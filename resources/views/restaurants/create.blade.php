@extends('layouts.app')
@section('content')


    <h2 class="text-center">
        Ciao {{ Auth::user()->name }}!
    </h2>

    <h1 class="text-center">Crea il tuo ristorante</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form id="myForm" action="{{ route('restaurant.store', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
        class="mt-4 d-flex flex-column justify-content-center align-items-center">
        @csrf
        @method('PUT')


        {{-- <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ Auth::user()->name }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </select> --}}

        <div class="input">
            <label class="label" for="name">Nome ristorante: </label>
            <input type="text" id="name" name="name" class="p-2">
            <div id="nameError" style="color: red; display: none;"></div>
        </div>

        <div class="input">
            <label class="label" for="address">Indirizzo ristorante: </label>
            <input id="address" type="text" name="address" placeholder="es: Via Milano 1, 20100" class="p-2">
            <div id="addressError" style="color: red; display: none;"></div>
        </div>

        <div class="input">
            <label class="label" for="piva">PIVA</label>
            <input type="text" id="piva" name="piva" placeholder="12345678901" class="p-2">
            <div id="pivaError" style="color: red; display: none;"></div>
        </div>

        <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" value="1">

        <div class="mt-2">
            <span class="d-block">Tipo di file (jpg, png, jpeg): </span>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <div id="imageError" style="color: red; display: none;"></div>
        </div>
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
            let pivaValue = document.getElementById("piva").value;
            let restaurantName = document.getElementById("name").value;
            let restaurantAddress = document.getElementById("address").value;
            let img = document.getElementById("image");

            counter = counter + checkPiva(pivaValue, counter);
            counter = counter + checkName(restaurantName, counter);
            counter = counter + checkAddress(restaurantAddress, counter);
            counter = counter + checkImage(img, counter);
            console.log(counter);

            if (counter === 4) {
                this.submit();
            }
        });

        function checkPiva(pivaValue, counter) {
            counter = 0;
            if (pivaValue.length === 0) {
                document.getElementById("pivaError").style.display = "block";
                document.getElementById("pivaError").innerHTML = "Compilare questo campo";
            } else if (!isNaN(pivaValue) && pivaValue.length === 11) {
                document.getElementById("pivaError").style.display = "none";
                counter++;
            } else {
                document.getElementById("pivaError").style.display = "block";
                document.getElementById("pivaError").innerHTML = "La P.IVA deve essere composta da 11 cifre numeriche.";
            }
            return counter;
        }

        function checkName(restaurantName, counter) {
            counter = 0;
            if (restaurantName.length === 0) {
                document.getElementById("nameError").style.display = "block";
                document.getElementById("nameError").innerHTML = "Compilare questo campo";
            } else {
                document.getElementById("nameError").style.display = "none";
                counter++;
            }
            return counter;
        }

        function checkAddress(restaurantAddress, counter) {
            counter = 0;
            if (restaurantAddress.length === 0) {
                document.getElementById("addressError").style.display = "block";
                document.getElementById("addressError").innerHTML = "Compilare questo campo";
            } else {
                document.getElementById("addressError").style.display = "none";
                counter++;
            }
            return counter;
        }

        function checkImage(img, counter) {
            counter = 0;

            // Ottieni il file selezionato dall'utente
            let file = img.files[0];

            // Verifica se un file è stato selezionato
            if (file) {
                // Verifica se il tipo del file è tra quelli consentiti
                if (file.type.includes('image/jpeg') || file.type.includes('image/png') || file.type.includes(
                        'image/jpg')) {
                    document.getElementById("imageError").style.display = "none";
                    counter++;
                } else {
                    document.getElementById("imageError").style.display = "block";
                    document.getElementById("imageError").innerHTML = "Formato non supportato";
                }
            } else {
                document.getElementById("imageError").style.display = "block";
                document.getElementById("imageError").innerHTML = "Immagine non caricata";
            }

            return counter;
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
