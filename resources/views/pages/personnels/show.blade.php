@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Ajouter un personnel</title>
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
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Détails du personnel
                        </h1>
                    </div>
                    <div class="col-auto mt-4">
                        <a href="{{ route('gestion_personnel.index') }}" class="btn btn-light"><i data-feather="align-left"></i>&thinsp;&thinsp;
                            Liste des personnels</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card p-4">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-center text-success mb-2">Details du personnel N° {{ $finds->id }}</h3>
                    <p class="text-center">Service du personnel : <span
                            class="badge bg-danger">{{ $finds->service->libelle ?? 'N/A' }}</span></p>
                    <!-- 👤 SECTION 1 : État Civil -->
                    <div class="mb-4">
                        <h5 class="text-success border-bottom pb-2 mb-3">👤 Détails</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"><strong>Nom :</strong>
                                    {{ $finds->nom }}
                                </div>
                                <div class="col-md-12"><strong>Prénom :</strong>
                                    {{ $finds->prenom }}
                                </div>
                                <div class="col-md-12"><strong>Email :</strong>
                                    {{ $finds->email }}
                                </div>
                                <div class="col-md-12"><strong>Téléphone :</strong>
                                    {{ $finds->telephone }}
                                </div>
                                <div class="col-md-12"><strong>Adresse :</strong>
                                    {{ $finds->adresse }}
                                </div>
                                <div class="col-md-12"><strong>Niveau Cadre :</strong>
                                    {{ $finds->niveau_cadre }}
                                </div>
                                <div class="col-md-12"><strong>Poste :</strong>
                                    {{ $finds->poste }}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h5 class="text-success border-bottom pb-2 mb-3">📝 Pièces jointes</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                @if ($finds->pj1)
                                    <li><a href="{{ asset('storage/' . $finds->pj1) }}" target="_blank">Pièce jointe 1</a></li>
                                @endif
                                @if ($finds->pj2)
                                    <li><a href="{{ asset('storage/' . $finds->pj2) }}" target="_blank">Pièce jointe 2</a></li>
                                @endif
                                @if ($finds->pj3)
                                    <li><a href="{{ asset('storage/' . $finds->pj3) }}" target="_blank">Pièce jointe 3</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-2 mt-4">
                        <a href="{{ route('gestion_personnel.edit', $finds->id) }}" class="btn btn-dark"><i data-feather="edit"></i>&thinsp;&thinsp;Modifier</a>
                        <form action="{{ route('gestion_personnel.destroy', $finds->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i data-feather="trash-2"></i>&thinsp;&thinsp;Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
