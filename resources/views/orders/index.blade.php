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
                                <th scope="col">Numero ordine</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Nome cliente</th>
                                <th scope="col">Indirizzo cliente</th>
                                <th scope="col">Email cliente</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->number_order }}
                                    </td>
                                    <td>
                                        {{ $order->price }} <p>€</p>
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
