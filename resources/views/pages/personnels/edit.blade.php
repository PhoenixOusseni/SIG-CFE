@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Modifier un personnel</title>
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
                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                            Modifier le personnel
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
        <!-- Example Charts for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('gestion_personnel.update', $finds->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label class="small">Code</label>
                                    <input type="text" name="code" class="form-control" value="{{ $finds->code }}" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="small">Nom</label>
                                    <input type="text" name="nom" class="form-control" value="{{ $finds->nom }}" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="small">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ $finds->prenom }}" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-2">
                                    <label class="small">Taux horaire</label>
                                    <input type="number" name="taux_horaire" class="form-control" value="{{ $finds->taux_horaire }}" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="service" class="small">Service</label>
                                    <select class="form-select" id="service" name="service_id" required>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ $finds->service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="small">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $finds->email }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="telephone" class="small">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $finds->telephone }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="adresse" class="small">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $finds->adresse }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="niveau_cadre" class="small">Niveau Cadre</label>
                                    <input type="text" class="form-control" id="niveau_cadre" name="niveau_cadre" value="{{ $finds->niveau_cadre }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="poste" class="small">Poste</label>
                                    <input type="text" class="form-control" id="poste" name="poste" value="{{ $finds->poste }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="pj1" class="small">PJ 1</label>
                                    <input type="file" class="form-control" id="pj1" name="pj1">
                                </div>
                                <div class="col-md-4">
                                    <label for="pj2" class="small">PJ 2</label>
                                    <input type="file" class="form-control" id="pj2" name="pj2">
                                </div>
                                <div class="col-md-4">
                                    <label for="pj3" class="small">PJ 3</label>
                                    <input type="file" class="form-control" id="pj3" name="pj3">
                                </div>
                            </div>

                            <div class="m-0">
                                <button type="submit" class="btn btn-dark"><i data-feather="edit"></i>&thinsp;&thinsp; Modifier</button>
                                <button type="reset" class="btn btn-danger"><i data-feather="x-circle"></i>&thinsp;&thinsp; Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
