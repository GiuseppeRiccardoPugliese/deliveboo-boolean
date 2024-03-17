@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Utente') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- NOME RISTORANTE --}}
                            <div class="mb-4 row">
                                <label for="restaurant_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="restaurant_name" type="name" class="form-control" name="restaurant_name"
                                        required autocomplete="restaurant_name">
                                </div>
                            </div>

                            {{-- INDIRIZZO RISTORANTE --}}
                            <div class="mb-4 row">
                                <label class="label" for="address">Indirizzo ristorante: </label>
                                <input id="address" type="text" name="address" placeholder="es: Via Milano 1, 20100"
                                    class="p-2">
                                <div id="addressError" style="color: red; display: none;"></div>
                            </div>

                            {{-- P.IVA RISTORANTE --}}
                            <div class="mb-4 row">
                                <label class="label" for="piva">PIVA</label>
                                <input type="text" id="piva" name="piva" placeholder="12345678901"
                                    class="p-2">
                                <div id="pivaError" style="color: red; display: none;"></div>
                            </div>

                            {{-- VISIBILITA' RISTORANTE --}}
                            <div class="mb-4 row">
                                <label class="label" for="visible">Visibilit&agrave;: </label>
                                <input type="checkbox" name="visible" value="1">
                            </div>

                            {{-- IMAGE RISTORANTE --}}
                            <div class="mb-4 row">
                                <span class="d-block">Tipo di file (jpg, png, jpeg): </span>
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image">
                                <div id="imageError" style="color: red; display: none;"></div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
