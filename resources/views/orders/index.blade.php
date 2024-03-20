@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i piatti:</h1>
    @endunless

    @auth
        <div class="container">
            <h2 class="fs-2 text-secondary my-4 text-center">{{ __('Ordini') }}</h2>
            <div class="row mb-3">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">numero ordine</th>
                            <th scope="col">prezzo</th>
                            <th scope="col">Nome utente</th>
                            <th scope="col">Email utente</th>
                            <th scope="col">Piatti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $orders->number_order }}
                                    </td>
                                    <td>
                                        {{ $orders->price }}
                                    </td>
                                    <td>
                                        {{ $orders->guest_name }}
                                    </td>
                                    <td>
                                        {{ $orders->guest_address }}
                                    </td>
                                    <td>
                                        {{ $orders->guest_email }}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach(json_decode($order->ordered_items) as $item)
                                                <li>{{ $orders->ordered_items }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endauth
@endsection