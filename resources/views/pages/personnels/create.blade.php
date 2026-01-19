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
                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                            Ajouter un personnel
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
                            <a href="{{ route('gestion_personnel.create') }}" class="btn btn-light"><i data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter un personnel</a>
                            <a href="{{ route('gestion_personnel.index') }}" class="btn btn-light"><i data-feather="align-left"></i>&thinsp;&thinsp;
                               Liste des personnels</a>
                        </div>
                        <form action="{{ route('gestion_personnel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Nom</label>
                                    <input type="text" name="nom" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="service" class="form-label">Service</label>
                                    <select class="form-select" id="service" name="service_id" required>
                                        <option selected disabled>Sélectionner un service...</option>
                                        @foreach ($services as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse">
                                </div>
                                <div class="col-md-4">
                                    <label for="niveau_cadre" class="form-label">Niveau Cadre</label>
                                    <input type="text" class="form-control" id="niveau_cadre" name="niveau_cadre">
                                </div>
                                <div class="col-md-4">
                                    <label for="poste" class="form-label">Poste</label>
                                    <input type="text" class="form-control" id="poste" name="poste">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="pj1" class="form-label">PJ 1</label>
                                    <input type="file" class="form-control" id="pj1" name="pj1">
                                </div>
                                <div class="col-md-4">
                                    <label for="pj2" class="form-label">PJ 2</label>
                                    <input type="file" class="form-control" id="pj2" name="pj2">
                                </div>
                                <div class="col-md-4">
                                    <label for="pj3" class="form-label">PJ 3</label>
                                    <input type="file" class="form-control" id="pj3" name="pj3">
                                </div>
                            </div>

                            <div class="m-0">
                                <button type="submit" class="btn btn-dark"><i data-feather="save"></i>&thinsp;&thinsp; Enregistrer</button>
                                <button type="reset" class="btn btn-danger"><i data-feather="x"></i>&thinsp;&thinsp; Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
