@extends('layouts.app')
@section('content')
    {{-- VALIDATION REQUEST --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dish.update', $dish->id) }}" method="POST" enctype="multipart/form-data"
        class="mt-4 d-flex flex-column justify-content-center align-items-center">
        @csrf
        @method('PUT')


        <div class="input">
            <label class="label" for="name">Nome piatto: </label>
            <input type="text" name="name" class="p-2" value="{{ $dish->name }}">
        </div>

        <div class="input">
            <label class="label" for="description">Descrizione piatto: </label>
            <input type="text" name="description" class="p-2" value="{{ $dish->description }}">
        </div>

        <div class="input">
            <label class="label" for="price">Price</label>
            <input type="text" name="price" placeholder="10.20" class="p-2" value="{{ $dish->price }}">
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png">
        </div>

        <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" {{ $dish->visible == 1 ? 'checked' : '' }}>

        <div class="mt-4">
            <input type="submit" value="UPDATE">
        </div>

    </form>
@endsection
