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

        <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" value="1">

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

            counter = counter + checkPrice(priceValue, counter);
            counter = counter + checkName(dishName, counter);
            counter = counter + checkDescription(dishDescription, counter);
            counter = counter + checkImage(img, counter);
            console.log(counter);

            if (counter === 4) {
                this.submit();
            }
        });

        function checkPrice(priceValue, counter) {
            counter = 0;
            if (priceValue.length === 0) {
                document.getElementById("priceError").style.display = "block";
                document.getElementById("priceError").innerHTML = "Compilare questo campo";
            } else if (!isNaN(priceValue) && priceValue > 0) {
                document.getElementById("priceError").style.display = "none";
                counter++;
            } else {
                document.getElementById("priceError").style.display = "block";
                document.getElementById("priceError").innerHTML =
                    "Il prezzo deve essere composto da un numero che sia positivo";
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

        function checkDescription(restaurantAddress, counter) {
            counter = 0;
            if (restaurantAddress.length === 0) {
                document.getElementById("descriptionError").style.display = "block";
                document.getElementById("descriptionError").innerHTML = "Compilare questo campo";
            } else {
                document.getElementById("descriptionError").style.display = "none";
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
