@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Détails du traitement</title>
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
                            Détails du traitement
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
                        <h3 class="text-center text-success mb-2">Details du traitement N° {{ $finds->id }}</h3>
                        <p class="text-center">Code : <span class="badge bg-danger">{{ $finds->code ?? 'N/A' }}</span></p>
                        <!-- 👤 SECTION 1 : État Civil -->
                        <div class="mb-4">
                            <h5 class="text-success border-bottom pb-2 mb-3">👤 Détails</h5>
                            <div class="row mt-3">
                                <div class="col-md-12"><strong>Service :</strong>
                                    {{ $finds->service->libelle ?? 'N/A' }}
                                </div>
                                <div class="col-md-12"><strong>Critère :</strong>
                                    {{ $finds->critere->code ?? 'N/A' }} {{ $finds->critere->designation ?? 'N/A' }}
                                </div>
                                <div class="col-md-12"><strong>Désignation :</strong>
                                    {{ $finds->designation ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3"><strong>Du :</strong>
                                    {{ $finds->date_debut ?? 'N/A' }}
                                </div>
                                <div class="col-md-3"><strong>Au :</strong>
                                    {{ $finds->date_fin ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><strong>Commentaire :</strong> <br>
                                    {{ $finds->commentaire ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 👤 SECTION 2 : Actions -->
                    <div class="d-flex justify-content-start gap-2 mt-4">
                        <a href="{{ route('gestion_traitement.edit', $finds->id) }}" class="btn btn-dark"><i
                                data-feather="edit"></i>&thinsp;&thinsp;Modifier</a>
                        <form action="{{ route('gestion_traitement.destroy', $finds->id) }}" method="POST"
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
