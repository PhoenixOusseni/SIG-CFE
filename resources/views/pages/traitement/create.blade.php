@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Crée traitement</title>
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
                            <div class="page-header-icon"><i data-feather="plus-circle"></i></div>
                            Crée traitement
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <!-- Example Charts for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="col-sm-12 mb-3">
                            <a href="{{ route('gestion_traitement.create') }}" class="btn btn-light"><i
                                    data-feather="plus"></i>&thinsp;&thinsp;
                                Crée opérations</a>
                            <a href="{{ route('gestion_traitement.index') }}" class="btn btn-light"><i
                                    data-feather="align-left"></i>&thinsp;&thinsp;
                                Révu de qualité</a>
                        </div>
                        <form action="{{ route('gestion_traitement.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small">Service</label>
                                    <select name="service_id" class="form-select" required>
                                        <option selected disabled>Sélectionner un service...</option>
                                        @foreach ($services as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small">Critère</label>
                                    <select name="critere_id" class="form-select" required>
                                        <option selected disabled>Sélectionner un critère...</option>
                                        @foreach ($criteres as $item)
                                            <option value="{{ $item->id }}">{{ $item->code }} {{ $item->designation }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small">Désignation</label>
                                    <input type="text" name="designation" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="small">Du</label>
                                    <input type="date" name="date_debut" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small">Au</label>
                                    <input type="date" name="date_fin" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="small">Commentaire...</label>
                                    <textarea name="commentaire" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="m-0">
                                <button type="submit" class="btn btn-dark"><i
                                        data-feather="check-circle"></i>&thinsp;&thinsp; Valider</button>
                                <button type="reset" class="btn btn-danger"><i data-feather="x"></i>&thinsp;&thinsp;
                                    Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
