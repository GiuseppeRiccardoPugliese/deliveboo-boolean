@extends('layouts.app')
@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i ristoranti: </h1>
    @endunless

    @auth
        @if (!$restaurants->where('user_id', Auth::id())->count())
            <h1>Crea il tuo ristorante da sogno!</h1>

            {{-- CREATE --}}
            <a href="{{ route('restaurant.create') }}">CREATE</a>
        @endif
    @endauth

    <ul>
        @foreach ($restaurants as $restaurant)
            @if (Auth::check())
                @if (Auth::user()->id == $restaurant->user_id)
                    <li>
                        {{ $restaurant->name }}

                        {{-- DELETE FORM --}}
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Elimina il tuo ristorante!</button>
                        </form>
                    </li>
                @endif
            @else
                <li>
                    {{ $restaurant->name }}
                </li>
            @endif
        @endforeach
    </ul>
@endsection
