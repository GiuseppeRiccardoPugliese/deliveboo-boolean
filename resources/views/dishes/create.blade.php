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
        <form id="myForm" action="{{ route('dish.store') }}" method="POST" enctype="multipart/form-data"  class="mt-4 d-flex flex-column justify-content-center align-items-center">
            @csrf
            @method('POST')

            <div class="input-group">
                <label for="name">Nome piatto:</label>
                <input type="text" id="name" name="name">
                <div id="nameError" style="color: red; display: none;"></div>
            </div>

            <div class="input-group">
                <label for="description">Descrizione piatto:</label>
                <input type="text" id="description" name="description">
                <div id="descriptionError" style="color: red; display: none;"></div>
            </div>

            <div class="input-group">
                <label for="price">Prezzo:</label>
                <input type="text" id="price" name="price" placeholder="inserisci il prezzo">
                <div id="priceError" style="color: red; display: none;"></div>
            </div>

            <div class="input-group">
                <label for="image">Immagine:</label>
                <input type="file" id="image" name="image">
                <div id="imageError" style="color: red; display: none;"></div>
            </div>

            {{--<div class="input-group">
                <label for="visible">Visibilità:</label>
                <input type="checkbox" id="visible" name="visible" value="1">
            </div>--}}

            <div class="input-group">
                <button type="submit" class="btn btn-primary btn-sm">CREA</button>
            </div>
        </form>
    </div>
</div> 
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
