@extends('layouts.app')

@section('page-title', $restaurant->activity_name)

@section('main-content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Header della Card con il nome del ristorante -->
                <div class="card-header text-success text-center">
                    <h1 class="mb-0">{{ $restaurant->activity_name }}</h1>
                </div>
                
                <!-- Corpo della Card -->
                <div class="card-body">
                    

                    <!-- Sezione Immagine -->
                    <div class="text-center my-1">
                        @if ($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" class="img-fluid rounded" alt="Immagine di {{ $restaurant->activity_name }}">
                        @else
                            <p class="text-muted">Nessuna immagine disponibile</p>
                        @endif
                    </div>

                    <p>di: <span class="fs-4 text-success">{{ $restaurant->user->name }}</span></p>
                    
                    <!-- Tipi di cucina -->
                    <div class="my-1">
                        <p class="d-inline fw-bolder">Cucina tipica:</p>
                        @forelse ($restaurant->types as $type)
                            <span class="badge rounded-pill bg-secondary">{{ $type->name }}</span>
                        @empty
                            <span class="text-muted">Nessuna tipologia specificata</span>
                        @endforelse
                    </div>

                    <!-- Descrizione e Partita IVA -->
                    <p>{{ $restaurant->description }}</p>
                    <p><span class="fw-bolder">P.IVA:</span> {{ $restaurant->VAT_number }}</p>
                </div>

                <!-- Footer della Card -->
                <div class="card-footer text-center">
                    <a class="btn text-light btn-secondary" href="{{ route('guest.restaurants.index') }}">
                        <i class="fa-solid fa-left-long"></i> Ristoranti
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection