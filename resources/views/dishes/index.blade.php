@extends('layouts.app')
@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i piatti: </h1>
    @endunless

    @auth
        <h1>Crea i tuoi piatti</h1>

        {{-- CREATE --}}
        <a href="{{ route('dish.create') }}">CREATE</a>
    @endauth

    <ul>
        @foreach ($dishes as $dish)
            @if (Auth::check())
                @if (Auth::user()->id == $dish->restaurant->user_id)
                    <li>
                        {{-- SHOW --}}
                        <a href="{{ route('dish.show', $dish->id) }}">
                            {{ $dish->name }}
                        </a>
                    </li>
                    {{-- EDIT --}}
                    <a href="{{ route('dish.edit', $dish->id) }}">EDIT</a>

                    {{-- DELETE --}}
                    <form action="{{ route('dish.destroy', $dish->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" id="destroy" name="destroy" value="DELETE">
                    </form>
                @endif
            @else
                <li>
                    {{ $dish->name }}
                </li>
            @endif
        @endforeach
    </ul>
@endsection
