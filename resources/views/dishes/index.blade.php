@extends('layouts.app')

@section('content')
    @unless (Auth::check())
        <h1>Ecco la lista di tutti i piatti:</h1>
    @endunless

    @auth
        <div class="container">
            <h2 class="fs-2 text-secondary my-4 text-center">{{ __('Menù') }}</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route('dish.create') }}" class="btn btn-sm btn-primary"><span class="plus"><i
                                class="fa-solid fa-plus"></i></span> Aggiungi Nuovo Piatto</a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Immagine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Visibilità</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $dish)
                            @if (Auth::user()->id == $dish->restaurant->user_id)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $dish->image) }}" class="img-thumbnail-small"
                                            alt="Immagine del piatto">
                                    </td>
                                    <td>
                                        {{ $dish->name }}
                                    </td>
                                    <td>
                                        {{ $dish->price }} €
                                    </td>
                                    <td>
                                        {{ $dish->description }}
                                    </td>
                                    <td>
                                        {{-- {{ $dish->visible == 0 ? 'No' : 'Si' }} --}}
                                        @if ($dish->visible == 0)
                                            <i class="fa-solid fa-xmark fs-3 text-danger"></i>
                                        @endif
                                        @if ($dish->visible == 1)
                                            <i class="fa-solid fa-check fs-4 text-success"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Azioni">
                                            <a href="{{ route('dish.edit', $dish->id) }}"
                                                class="btn btn-outline-primary sm rounded">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button type="button" class="btn btn btn-outline-danger sm rounded"
                                                onclick="confirmDelete('{{ $dish->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endauth

    <!-- Modal di conferma eliminazione -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma eliminazione</h5>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare questo piatto?
            </div>
            <div class="modal-footer">
            <button id="cancelButton" type="button" class="btn btn-secondary">Annulla</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
        function confirmDelete(dishId) {
            jQuery('#delete-form').attr('action', "{{ route('dish.destroy', '') }}" + '/' + dishId);
            jQuery('#confirmDeleteModal').modal('show');

        }
        document.getElementById('cancelButton').onclick = function() {
            var modalElement = document.getElementById('confirmDeleteModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
        };
</script>
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

    .btn-group .btn-outline-primary {
        font-size: 20px;
        margin-right: 10px;
    }

    .btn-group .btn-outline-danger {
        font-size: 20px;
    }

    .img-thumbnail-small {
        max-width: 100px;
        height: auto;
    }
</style>

<!-- link font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>




