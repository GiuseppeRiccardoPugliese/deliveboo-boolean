@extends('layouts.app')
@section('content')
    @unless (Auth::check())
        <div class="welcome-container">
            <h1 class="welcome-text">BENVENUTO SU DELIVEBOO!</h1>
            <img class="delivery-icon" src="https://media.tenor.com/6kcRQbF0j6oAAAAi/delivery-food.gif" alt="Delivery Icon">
        </div>
    @endunless

    <!-- @auth
                @if (!$restaurants->where('user_id', Auth::id())->count())
        <h1>Crea il tuo ristorante da sogno!</h1>

                    {{-- CREATE --}}
                    <a href="{{ route('restaurant.create') }}">CREATE</a>
        @endif
        @endauth -->
@endsection

<style>
    .welcome-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: calc(100vh - 66px);
    }

    .welcome-text {
        font-size: 48px;
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        animation: pulse 2s infinite alternate;
    }

    .delivery-icon {
        width: 300px;
        height: 300px;
        margin-bottom: 20px;
        animation: pulse 2s infinite alternate;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.1);
        }
    }
</style>
