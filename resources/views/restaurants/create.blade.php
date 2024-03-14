@extends('layouts.app')
@section('content')
    <h1 class="text-center">Crea ristorante</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('restaurant.store', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
        class="mt-4 d-flex flex-column justify-content-center align-items-center">
        @csrf
        @method('PUT')

        <h2>
            Ciao {{ Auth::user()->name }}
        </h2>

        <div class="input">
            <label class="label" for="name">Nome ristorante: </label>
            <input type="text" name="name" class="p-2">
        </div>

        <div class="input">
            <label class="label" for="address">Indirizzo ristorante: </label>
            <input type="text" name="address" placeholder="es: Via Milano 1, 20100" class="p-2">
        </div>

        <div class="input">
            <label class="label" for="piva">PIVA</label>
            <input type="text" name="piva" placeholder="12345678901" class="p-2">
        </div>

        <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" value="1">

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png">
        </div>
        <div class="mt-4">
            <input type="submit" value="CREATE">
        </div>

    </form>
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
