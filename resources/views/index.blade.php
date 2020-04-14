@extends('layouts.app')
@section('content')
    <div class="container-fluid pr-5 pl-5 border-bottom border-info">
        <div class="col-12 mt-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-4">
                    <select class="custom-select" id="numRooms">
                      <option selected>Numero stanze</option>
                      @for ($i=1; $i <= 10; $i++)
                          <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <select class="custom-select" id="numGuests">
                      <option selected>Numero ospiti</option>
                      @for ($i=1; $i <= 10; $i++)
                          <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                </div>
                <div class="col-12 col-md-4 inputRange">
                    <label for="customRange2">Distanza: <span id="kmOutput">20</span> Km</label>
                    <input type="range" class="custom-range" min="1" max="200" value="20" id="kmRange">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <p>Servizi:</p>
                    @foreach ($options as $option)
                        <input type="checkbox" id="{{$option->nome}}" name="optionSelected_id" value="{{$option->id}}">
                        <label class="mr-3" for="{{$option->nome}}">{{$option->nome}}</label>
                    @endforeach
                </div>
                <div class="col-12 col-md-4 text-center">
                    <button type="button" name="button" class="btn btn-info" id="btnFilters">Applica</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h1>Risultati di ricerca</h1>
            </div>
            <div class="results-search d-flex flex-wrap col-12">
                @forelse ($apartments as $apartment)
                    <div class="col-12 col-md-6 col-xl-3 mb-3">
                        <div class="card">
                            <img src="https://eolieexcursions.it/thumbsx.aspx?Id=13&cosa=SchedeGallery&Lato=256&Formato=X&src=IMG_7715.JPG" class="card-img-top" alt="foto . {{$apartment->titolo}}">
                            <div class="card-body">
                              <h5 class="card-title" style="height: 48px;">{{$apartment->titolo}}</h5>
                              <p class="card-text" style="height: 72px;">{{$apartment->indirizzo}}</p>
                              <a href="{{route('show', $apartment->id)}}" class="btn btn-info">Mostra dettagli</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>Non ci sono appartamenti da mostrare</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <script id="card-template" type="text/x-handlebars-template">
        <div class="col-12 col-md-6 col-xl-3 mb-3">
            <div class="card" >
                <img src="https://eolieexcursions.it/thumbsx.aspx?Id=13&cosa=SchedeGallery&Lato=256&Formato=X&src=IMG_7715.JPG" class="card-img-top" alt="foto . @{{titolo}}">
                <div class="card-body">
                  <h5 class="card-title" style="height: 48px;">@{{titolo}}</h5>
                  <p class="card-text" style="height: 72px;">@{{indirizzo}}</p>
                  <a href="http://localhost:8000/apartment/@{{id}}" class="btn btn-info">Mostra dettagli</a>
                </div>
            </div>
        </div>
    </script>
@endsection
