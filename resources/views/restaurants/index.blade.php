@extends('layouts.app')
@section('content')
    @unless (Auth::check())
    <div class>
        <h1 class="d-flex justify-content-center align-items-center">BENVENUTO SU DELIVEBOO!</h1>
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
