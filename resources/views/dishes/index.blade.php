@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i piatti:</h1>
    @endunless

    @auth
        <div class="container">
            <h2 class="fs-2 text-secondary my-4 text-center">{{ __('Menù') }}</h2>
            <div class="row mb-3 justify-content-end">
                <a href="{{ route('dish.create') }}" class="btn-create"><span class="plus">Aggiungi Nuovo Piatto</span></a>
            </div>
            <div class="row">
                <ul class="list-group p-0">
                    @foreach ($dishes as $dish)
                        @if (Auth::user()->id == $dish->restaurant->user_id)
                            <li class="list-group-item border-1 rounded-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $dish->image) }}" class="img-thumbnail"
                                            alt="Immagine del piatto">
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-center"><a href="{{ route('dish.show', $dish->id) }}"
                                                class="text-decoration-none">Nome del piatto:
                                                {{ $dish->name }}</a></h3>
                                        <p class="text-center">Descrizione: {{ $dish->description }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-group align-items-center" role="group" aria-label="Azioni">
                                            <a href="{{ route('dish.edit', $dish->id) }}"
                                                class="btn btn-primary btn-sm w-100 h-100 rounded-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form class="m-0" action="{{ route('dish.destroy', $dish->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endauth
@endsection






<style>
    .plus {
        vertical-align: middle;
    }

    .img-thumbnail {
        max-width: 50%;
        height: auto;
    }

    .list-group-item {
        margin-bottom: 20px;
    }

    .btn-create {
        display: inline-block;
        background-color: #13dbe6;
        border-radius: 100px;
        color: #fff;
        border: none;
        height: 40px;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        position: relative;
        text-decoration: none;
    }

    .btn-group .btn-primary {
        font-size: 20px;
        margin-right: 10px;
    }

    .btn-group .btn-danger {
        font-size: 20px;
    }
</style>

<!-- link font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
