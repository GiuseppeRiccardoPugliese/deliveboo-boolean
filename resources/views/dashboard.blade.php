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

            const orders_{{ $restaurant->id }} = @json($restaurant->orders);

            // Creare un oggetto per tenere traccia delle somme degli ordini per ogni mese
            const ordersData_{{ $restaurant->id }} = {};
            
            // Iterare attraverso gli ordini e sommare gli importi per ogni mese
            orders_{{ $restaurant->id }}.forEach(function(order) {
                const orderDate = new Date(order.created_at);
                const orderMonth = orderDate.toLocaleString('default', { month: 'long' }); // Estrae il nome del mese
                const orderPrice = parseFloat(order.price); // Converti il prezzo in un numero
                ordersData_{{ $restaurant->id }}[orderMonth] = (ordersData_{{ $restaurant->id }}[orderMonth] || 0) + orderPrice;
            });

            // Estrai le etichette e i dati dai risultati aggregati degli ordini
            const labels = Object.keys(ordersData_{{ $restaurant->id }}).sort(function(a, b) {
                return new Date(a + " 1, 2000").getTime() - new Date(b + " 1, 2000").getTime(); // Ordina i mesi cronologicamente
            });
            const data = labels.map(function(label) {
                return ordersData_{{ $restaurant->id }}[label];
            });

            console.log(ordersData_{{ $restaurant->id }});

            new Chart(ctx_{{ $restaurant->id }}, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'ORDINI TOTALI MENSILI NEL 2024',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1
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
