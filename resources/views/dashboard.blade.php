@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-2 text-secondary my-4 text-center">
            {{ __('Pannello di Controllo') }}
        </h2>
        <div class="row justify-content-center">
            @foreach ($restaurants as $restaurant)
                @if (Auth::user()->id == $restaurant->user_id)
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <img src="{{ asset('storage/' . $restaurant->image) }}" style="height: 300px"
                                        class="card-img-top" alt="Immagine del ristorante">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                                        <p class="card-text">Indirizzo: {{ $restaurant->address }}</p>
                                        <p class="card-text">Partita IVA: {{ $restaurant->piva }}</p>
                                        <p class="card-text"><small class="text-muted">Visibile:
                                                {{ $restaurant->visible == 0 ? 'No' : 'Si' }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <canvas id="myChart_{{ $restaurant->id }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        @endif
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($restaurants as $restaurant)
                @if (Auth::user()->id == $restaurant->user_id)
                    const ctx_{{ $restaurant->id }} = document.getElementById('myChart_{{ $restaurant->id }}');
                    const labels = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ];

                    // Recupera i dati degli ordini per questo ristorante
                    const ordersData_{{ $restaurant->id }} = @json($restaurant->orders->pluck('price'));

                    new Chart(ctx_{{ $restaurant->id }}, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'My First Dataset',
                                data: ordersData_{{ $restaurant->id }},
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                @endif
            @endforeach
        });
    </script>
       
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
        height: 200px;
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
</style>
