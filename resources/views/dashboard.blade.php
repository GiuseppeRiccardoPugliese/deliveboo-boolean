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
                            <div class="info-restaurant col-md-6">
                                <div class="card mb-3">
                                    <div class="restaurant-image">
                                        <img src="{{ asset('storage/' . $restaurant->image) }}" style="height: 320px"
                                        class="card-img-top" alt="Immagine del ristorante">
                                    </div>
                                    
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
                                    <div class="chart-container">
                                        <canvas id="myChart_{{ $restaurant->id }}" style="height: 100%; width: 100%" ></canvas>
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

          
           // Definire i nomi dei mesi in italiano
            const monthsInOrder = ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'];

            // Ordinare le chiavi (mesi) dall'oggetto in base all'ordine definito
            const labels = Object.keys(ordersData_{{ $restaurant->id }}).sort(function(a, b) {
                return monthsInOrder.indexOf(a) - monthsInOrder.indexOf(b);
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
                        backgroundColor: [
                            '#f5314a',
                            '#ae3f68',
                            '#5a6690',
                            '#e65b72',
                            '#7be7ea', 
                            '#f6a6b0',
                            '#874879',
                            '#db3755',
                            '#13dbe6',
                            '#4a6c94',
                            '#2eb2c3',
                            '#2aa4bb'
                        ],
                        // borderColor: 'rgb(54, 162, 235)',
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
        height: 100%;
        /* Altezza dell'immagine */
        object-fit: cover;
        /* Immagine adattata alla dimensione dell'elemento */
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
    .restaurant-image {
        width: 100%;
        height: 331px;
    }

    .info-restaurant{
        width: 100%;
        height: 480px;
        margin-bottom: 50px;
    }
    .chart-container {
        width: 100%;
        height: 480px;
       
    }
</style>
