@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i piatti:</h1>
    @endunless

    @auth
        <div class="container">
            <h2 class="fs-4 text-secondary my-4">{{ __('Menù') }}</h2>
            <div class="row mb-3 justify-content-end">
                <a href="{{ route('dish.create') }}" class="btn-create"><span class="plus">Aggiungi Nuovo Piatto</span></a>
            </div>
            <div class="row row-cols-md-3">
                @foreach ($dishes as $dish)
                    @if (Auth::user()->id == $dish->restaurant->user_id)
                        <div class="col mb-1">
                            <div class="card">
                                <img src="{{ asset('storage/' . $dish->image) }}" style="height: 250px" class="card-img-top"
                                    alt="Immagine del piatto">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $dish->name }}</h5>
                                    <p class="card-text">{{ $dish->description }}</p>
                                    <div class="btn-group" role="group" aria-label="Azioni">
                                        <a href="{{ route('dish.edit', $dish->id) }}" class="btn btn btn-primary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('dish.destroy', $dish->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endauth
@endsection






<style>
    .card {
        border: 1px solid #ddd;
        /* Bordo della card */
        border-radius: 10px;
        /* Bordi arrotondati */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Ombra */
        transition: box-shadow 0.3s ease-in-out;
        /* Transizione ombra */
        padding: 10px;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Ombra leggermente più pronunciata al passaggio del mouse */
    }

    .card-img-top {
        border-radius: 10px;
        /* Bordi arrotondati solo in alto a sinistra */
        height: 100px;
        /* Altezza dell'immagine */
        object-fit: cover;
        /* Immagine adattata alla dimensione dell'elemento */
    }

    .card-body {
        padding: 1.25rem;
        /* Spaziatura interna */
    }

    .card-title {
        font-size: 1.25rem;
        /* Dimensione del titolo */
        margin-bottom: 0.75rem;
        /* Margine inferiore */
    }

    .card-text {
        margin-bottom: 0.5rem;
        /* Margine inferiore */
    }

    .btn-create {
        display: inline-block;
        background-color: #13dbe6;
        border-radius: 100px;
        color: #fff;
        border: none;
        height: 40px;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        position: relative;
    }

.btn-group .btn-primary{
    margin-right: 10px;
    color: #fff;
}

    .plus {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

.card-body .btn-group {
    margin-top: 20px; /* Regola lo spazio tra i pulsanti Edit e Delete */
    font-size: 5px;
}
</style>
<!-- link font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />