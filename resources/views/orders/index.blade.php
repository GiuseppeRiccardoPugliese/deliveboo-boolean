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
            <div class="row justify-content-center mt-4">
                <div class="col-md-1 text-center blue-box">Ordini Totali: {{ count($orders) }}</div>
            </div>

            <div class="container">
                <div class="card">
                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">
                        <table class="table table-striped mb-0">
                            <thead class="msbgazzurro">
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Ora</th>
                                    <th scope="col">Identificativo</th>
                                    <th scope="col">Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Europe/Rome')->locale('it')->isoFormat('DD-MM-YYYY') }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Europe/Rome')->locale('it')->isoFormat('HH:mm') }}
                                        </td>

                                        <td>
                                            {{ $order->number_order }}
                                        </td>

                                        <td>
                                            {{ $order->price }} <span>€</span>
                                        </td>

                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}"
                                                class="btn btn-sm btn-primary view-order">
                                                visualizza
                                            </a>
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

<script>
    $(document).ready(function() {
        $('.view-order').click(function() {
            var orderId = $(this).data('order-id');
            window.location.href = '/orders/' + orderId;
        });
    });
</script>

<style>
    .blue-box {
        background-color: #13dbe6;
        padding: 5px;
        border-radius: 5px;
        color: #ffffff;
        margin-bottom: 10px;
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
