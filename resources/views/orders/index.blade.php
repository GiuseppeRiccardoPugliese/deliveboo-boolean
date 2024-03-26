@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista dei tuoi piatti:</h1>
    @endunless

    @auth
        <div class="container">
            <h2 class="fs-2 text-secondary my-4 text-center">{{ __('Ordini') }}</h2>
            <div class="row mb-3">
                <div class="row">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">
                                    <div class="blue-box">Ordini Totali: {{ count($orders) }}</div>
                                </th>
                                <th scope="col">Ora</th>
                                <th scope="col">Identificativo</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Indirizzo</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Europe/Rome')->locale('it')->isoFormat('D-MM-YYYY') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Europe/Rome')->locale('it')->isoFormat('HH:mm') }}
                                    </td>
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
        @endauth
    @endsection

    // Formatta created_at in formato italiano
    foreach ($orders as $order) {
    $order->formatted_created_at = Carbon::parse($order->created_at)->locale('it')->format('d/m/Y, H:i:s');
    }

    <style>
        .blue-box {
            background-color: #13dbe6;
            padding: 5px;
            border-radius: 5px;
            color: #ffffff;
        }
    </style>
