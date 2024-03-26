@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista dei tuoi piatti:</h1>
    @endunless

    @auth
    <section class="intro">
      <div class="container">
        <h2 class="fs-2 text-secondary my-4 text-center">{{ __('Ordini') }}</h2>
      </div>

        <div class="container">
            <div class="card">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
                    <table class="table table-striped mb-0">
                        <thead class="msbgazzurro">
                            <tr>
                            <th scope="col">
                                    <div class="blue-box">Ordini Totali: {{ count($orders) }}</div>
                                </th>
                                <th scope="col">Identificativo</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Indirizzo</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        {{ $order->number_order }}
                                    </td>
                                    <td>
                                        {{ $order->price }} <span>€</span>
                                    </td>
                                    <td>
                                        {{ $order->guest_name }}
                                    </td>
                                    <td>
                                        {{ $order->guest_address }}
                                    </td>
                                    <td>
                                        {{ $order->guest_email }}
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endauth
@endsection

    <style>
        .blue-box {
            background-color: #13dbe6;
            padding: 5px;
            border-radius: 5px;
            color: #ffffff;
        }
        
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
