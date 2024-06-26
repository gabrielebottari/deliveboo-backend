@extends('layouts.app')

@section('page-title', 'I miei Piatti')

@section('main-content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3 text-success">I miei Piatti</h1>
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('admin.plates.create') }}" class="btn btn-secondary text-white me-3"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-bowl-food"></i> Nuovo piatto</a>
                <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#deletedItemsModal">
                    <i class="fa-solid fa-recycle"></i> ripristina piatti
                </button>
            </div>



            <!-- Modale per gli elementi cancellati -->
            <div class="modal fade" id="deletedItemsModal" tabindex="-1" aria-labelledby="deletedItemsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-success">
                        <div class="modal-header bg-light border-success">
                            <h5 class="modal-title text-success" id="deletedItemsModalLabel">Piatti Cancellati</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @forelse ($deletedPlates as $plate)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    {{ $plate->name }}
                                    <form method="POST" action="{{ route('admin.plates.restore', $plate->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success"> <i class="fa-solid fa-recycle"></i> Ripristina</button>
                                    </form>
                                </div>
                            @empty
                                <p>Nessun piatto eliminato da mostrare.</p>
                            @endforelse
                        </div>
                        <div class="modal-footer bg-light border-success">
                            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i> Chiudi</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($plates->isEmpty())
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-secondary w-50 text-center" role="alert">
                            Nessun Piatto Presente.
                        </div>
                    </div>
                @else

                @foreach ($plates as $plate)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-success h-100">
                        @if($plate->image)
                            <img src="{{ asset('storage/' . $plate->image) }}" class="card-img-top border-bottom border-success" alt="{{ $plate->name }}">
                        @else
                            <img src="{{ Vite::asset('resources/img/plate-not-found.png') }}"class="card-img-top border-bottom border-success"  alt="not-found">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $plate->name }}</h5>
                            <p>Prezzo: <span class="fw-bold">{{ number_format($plate->price, 2) }}€</span></p>
                            @if($plate->visible)
                                <span class="text-info">Disponibile <i class="fa-solid fa-check"></i></span>
                            @else
                                <span class="text-danger"><del>Non Disponibile</del></span>
                            @endif
                            <p>Ingredienti: {{ $plate->ingredients }}</p>
                            <p class="card-text mt-3">{{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                        </div>
                        
                        <div class="card-footer border-success bg-light text-center">
                            <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Modifica</a>
                            
                            {{-- Bottone che apre il Modal specifico per il piatto --}}
                            <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $plate->id }}">
                                <i class="fa-solid fa-trash"></i> Elimina
                            </button>
                            
                            {{-- Modal specifico per il piatto --}}
                            <div class="modal fade" id="deleteModal{{ $plate->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $plate->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header border-success bg-light">
                                            <h5 class="modal-title text-success" id="deleteModalLabel{{ $plate->id }}">Conferma Eliminazione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Vuoi davvero eliminare il Piatto {{ $plate->name }}?
                                        </div>
                                        <div class="modal-footer border-success bg-light">
                                            <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>
                                            <form action="{{ route('admin.plates.destroy', $plate->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-trash"></i> Sì, voglio Eliminarlo</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection