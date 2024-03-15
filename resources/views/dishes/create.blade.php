@extends('layouts.app')
@section('content')
    <form action="{{ route('dish.store') }}" method="POST" enctype="multipart/form-data"
        class="mt-4 d-flex flex-column justify-content-center align-items-center">
        @csrf
        @method('POST')


        <div class="input">
            <label class="label" for="name">Nome piatto: </label>
            <input type="text" name="name" class="p-2">
        </div>

        <div class="input">
            <label class="label" for="description">Descrizione piatto: </label>
            <input type="text" name="description" class="p-2">
        </div>

        <div class="input">
            <label class="label" for="price">Price</label>
            <input type="text" name="price" placeholder="10.20" class="p-2">
        </div>

        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png">
        </div>

        <label class="label" for="visible">Visibilit&agrave;: </label>
        <input type="checkbox" name="visible" value="1">

        <div class="mt-4">
            <input type="submit" value="CREATE">
        </div>

    </form>
@endsection
