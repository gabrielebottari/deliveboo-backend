@extends('layouts.app')

@section('page-title', '404 - Not found')

@section('main-content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center" style="padding-top: 15%">
            <img src="{{ Vite::asset('resources/img/error-404.png') }}" alt="404" style="width: 250px">
            <h1 class="text-success">Ops... qualcosa è andato storto</h1>
            <h2 class="mb-3">La pagina che stavi cercando non esiste</h2>
        </div>
    </div>
@endsection
