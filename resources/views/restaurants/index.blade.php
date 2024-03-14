@extends('layouts.app')
@section('content')
    <h1>Il mio ristorante: </h1>

    {{-- CREATE --}}
    @auth
    <a href="{{ route('restaurant.create') }}">CREATE</a>
    @endauth
    
    <ul>
        @foreach ($restaurants as $restaurant)
            <li>
                {{ $restaurant->name }}
            </li>
        @endforeach
    </ul>
@endsection
