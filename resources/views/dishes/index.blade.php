@extends('layouts.app')
@section('content')
    <h1>I miei piatti: </h1>

    {{-- CREATE --}}
    @auth
        <a href="{{ route('dish.create') }}">CREATE</a>
    @endauth

    <ul>
        @foreach ($dishes as $dish)
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
        @endforeach
    </ul>
@endsection
