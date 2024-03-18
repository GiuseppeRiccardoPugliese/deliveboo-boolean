@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
    @foreach ($restaurants as $restaurant)
        @if (Auth::user()->id == $restaurant->user_id)
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <img src="{{ $restaurant->image }}" class="card-img-top" alt="Immagine del ristorante">
                        <div class="card-body">
                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                            <p class="card-text">Indirizzo: {{ $restaurant->address }}</p>
                            <p class="card-text">Partita IVA: {{ $restaurant->piva }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
        @endif
    @endforeach
</div>
@endsection

<style>
.card {
    border: 1px solid #ddd; /* Bordo della card */
    border-radius: 10px; /* Bordi arrotondati */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombra */
    transition: box-shadow 0.3s ease-in-out; /* Transizione ombra */
    padding: 10px;
}

.card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombra leggermente più pronunciata al passaggio del mouse */
}

.card-img-top {
    border-radius: 10px; /* Bordi arrotondati solo in alto a sinistra */
    height: 200px; /* Altezza dell'immagine */
    object-fit: cover; /* Immagine adattata alla dimensione dell'elemento */
}

.card-body {
    padding: 1.25rem; /* Spaziatura interna */
}

.card-title {
    font-size: 1.25rem; /* Dimensione del titolo */
    margin-bottom: 0.75rem; /* Margine inferiore */
}

.card-text {
    margin-bottom: 0.5rem; /* Margine inferiore */
}
</style>
