@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Détails de la diligence</title>
@endsection

@section('style')
    @include('partials.style')
@endsection

@section('content')
    <header class="page-header page-header-dark header-gradient pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="eye"></i></div>
                            Détails de la diligence
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card p-4">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h3 class="text-center text-success mb-2">Details de la diligence N° {{ $finds->id }}</h3>
                        <p class="text-center">Code : <span class="badge bg-danger">{{ $finds->code ?? 'N/A' }}</span></p>
                        <!-- 👤 SECTION 1 : État Civil -->
                        <div class="mb-4">
                            <h5 class="text-success border-bottom pb-2 mb-3">👤 Détails</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12"><strong>Personnel :</strong>
                                        {{ $finds->personnel->nom ?? 'N/A' }} {{ $finds->personnel->prenom ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12"><strong>Département :</strong>
                                        {{ $finds->service->libelle ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12"><strong>Marché :</strong>
                                        {{ $finds->marche->designation ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-12"><strong>Désignation :</strong>
                                    {{ $finds->designation ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12"><strong>Taux :</strong>
                                    {{ $finds->taux ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12"><strong>Contraintes :</strong> <br>
                                    {{ $finds->contrainte }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h5 class="text-success border-bottom pb-2 mb-3">📝 Pièces jointes</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                @if ($finds->pj1)
                                    <li><a href="{{ asset('storage/' . $finds->pj1) }}" target="_blank">Pièce jointe 1</a>
                                    </li>
                                @endif
                                @if ($finds->pj2)
                                    <li><a href="{{ asset('storage/' . $finds->pj2) }}" target="_blank">Pièce jointe 2</a>
                                    </li>
                                @endif
                                @if ($finds->pj3)
                                    <li><a href="{{ asset('storage/' . $finds->pj3) }}" target="_blank">Pièce jointe 3</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-2 mt-4">
                        <a href="{{ route('gestion_diligence.edit', $finds->id) }}" class="btn btn-dark"><i
                                data-feather="edit"></i>&thinsp;&thinsp;Modifier</a>
                        <form action="{{ route('gestion_diligence.destroy', $finds->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i
                                    data-feather="trash-2"></i>&thinsp;&thinsp;Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
