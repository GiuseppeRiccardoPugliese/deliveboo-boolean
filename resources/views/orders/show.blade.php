@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Dettagli dell'Ordine</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                Ordine #{{ $order->number_order }}
            </div>
            <div class="card-body">
                <p class="card-text">Data e Ora: {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Europe/Rome')->locale('it')->isoFormat('D-MM-YYYY HH:mm') }}</p>
                <p class="card-text">Prezzo Totale: {{ $order->price }} €</p>
                <p class="card-text">Nome Cliente: {{ $order->guest_name }}</p>
                <p class="card-text">Indirizzo: {{ $order->guest_address }}</p>
                <p class="card-text">Email: {{ $order->guest_email }}</p>
            </div>
        </div>

        <h2 class="my-4">Piatti nell'Ordine</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantità</th>
                        <th>Descrizione</th>
                        <th>Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->dishes as $dish)
                        <tr>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->pivot->quantity }}</td>
                            <td>{{ $dish->description }}</td>
                            <td>{{ $dish->price }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

         .table-scroll {
        border-radius: .5rem;
        }

        .table-scroll table thead th {
        font-size: 1.25rem;
        }
    </style>
