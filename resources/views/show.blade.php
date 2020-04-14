@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h1>Dettagli appartamento</h1>
                <h3 class="text-info"><em>{{$apartment->titolo}}</em></h3>
                <hr>
            </div>
            <div class="col-12 col-md-4">
                <div class="col-12  mb-3">
                    <img class="w-100" src="https://eolieexcursions.it/thumbsx.aspx?Id=13&cosa=SchedeGallery&Lato=256&Formato=X&src=IMG_7715.JPG" alt="Foto appartamento">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="col-12">
                    <p><strong class="text-info">Numero di stanze:</strong> {{$apartment->stanze}}</p>
                    <p><strong class="text-info">Numero di posti letto:</strong> {{$apartment->posti_letto}}</p>
                    <p><strong class="text-info">Numero di bagni:</strong> {{$apartment->bagni}}</p>
                    <p><strong class="text-info">Dimensioni (mq):</strong> {{$apartment->dimensioni}}</p>
                    <p><strong class="text-info">Indirizzo:</strong> {{$apartment->indirizzo}}</p>
                    <hr>
                    <p><strong class="text-info">Descrizione:</strong> {{$apartment->descrizione}}</p>
                    <hr>
                    <p><strong class="text-info">Servizi:</strong></p>
                    <ul>
                        @forelse ($apartment->options as $option)
                          <li>{{ $option->nome }}</li>
                        @empty
                            -
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
