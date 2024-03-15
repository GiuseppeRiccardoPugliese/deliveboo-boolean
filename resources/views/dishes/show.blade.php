@extends('layouts.app')
@section('content')
    <h1>Piatto: [{{ $dish->id }}]</h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Nome piatto:
                        {{ $dish->name }}</h5>
                    <p class="card-text">Descrizione del piatto: {{ $dish->description }}</p>

                    <p class="card-text"><small class="text-muted">Prezzo:
                            {{ $dish->price }}</small>
                    </p>
                    <p class="card-text"><small class="text-muted">Visibile:
                            {{ $dish->visible == 0 ? 'No' : 'Si' }}</small>
                    </p>
                    {{-- Gestione per visualizzare la img --}}
                    <img src="{{ asset('storage/' . $dish->image) }}" class="img-fluid rounded-start" alt="..."
                        width="250px">

                </div>
            </div>
        </div>
    </div>
@endsection
