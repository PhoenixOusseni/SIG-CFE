@extends('layouts.master')
@section('title')
    <title>SIG - CFE | Ajouter un marché</title>
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
                            Ajouter un marché
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
                            <a href="{{ route('gestion_marche.create') }}" class="btn btn-light"><i
                                    data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter un marché</a>
                            <a href="{{ route('gestion_marche.index') }}" class="btn btn-light"><i
                                    data-feather="align-left"></i>&thinsp;&thinsp;
                                Liste des marchés</a>
                        </div>
                        <form action="{{ route('gestion_marche.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label class="small">Code</label>
                                    <input type="text" name="code" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-5">
                                    <label class="small">Désignation</label>
                                    <input type="text" name="designation" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-5">
                                    <label class="small">Montant du marché</label>
                                    <input type="text" name="montant" class="form-control" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="date_debut" class="small">Date debut</label>
                                    <input type="date" class="form-control" id="date_debut" name="date_debut">
                                </div>
                                <div class="col-md-2">
                                    <label for="date_cloture" class="small">Date cloture</label>
                                    <input type="date" class="form-control" id="date_cloture" name="date_cloture">
                                </div>
                                <div class="col-md-4">
                                    <label for="prestation" class="small">Prestation</label>
                                    <select class="form-select" id="prestation" name="base_taxable_id" required>
                                        <option selected disabled>Sélectionner une prestation...</option>
                                        @foreach ($prestations as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="client" class="small">Client</label>
                                    <select class="form-select" id="client" name="contribuable_id" required>
                                        <option selected disabled>Sélectionner un client...</option>
                                        @foreach ($clients as $item)
                                            <option value="{{ $item->id }}">{{ $item->assujeti }}</option>
                                        @endforeach
                                    </select>
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
                            <hr>

                            <h4 class="mt-3 mb-3 text-success">Equipe du marché</h4>

                            <div style="background: rgba(219, 218, 216, 0.248); padding: 5px; border-radius: 5px">
                                <div id="equipeContainer">
                                    <div class="row mb-3 equipe-row">
                                        <div class="col-md-5">
                                            <label class="small">Personnels</label>
                                            <select name="personnel_id[]" class="form-select personnel-select">
                                                <option value="" selected disabled>Sélectionner un personnel...</option>
                                                @foreach ($personnels as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nom }} {{ $item->prenom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small">Temps</label>
                                            <input type="text" name="temps[]" class="form-control">
                                            <div class="invalid-feedback">Ce champ est requis</div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-success btn-sm me-2" id="addRowBtn"><i
                                                    data-feather="plus"></i>&thinsp;&thinsp; Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-dark"><i data-feather="save"></i>&thinsp;&thinsp;
                                    Enregistrer</button>
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

@section('script')
    <script>
        $(document).ready(function() {
            // Variable pour stocker le HTML des options de personnel
            let personnelOptions = `
                <option value="" selected disabled>Sélectionner un personnel...</option>
                @foreach ($personnels as $item)
                    <option value="{{ $item->id }}">{{ $item->assujeti }}</option>
                @endforeach
            `;

            // Fonction pour réinitialiser les icônes Feather
            function refreshFeatherIcons() {
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }

            // Ajouter une nouvelle ligne
            $(document).on('click', '#addRowBtn', function() {
                let newRow = `
                    <div class="row mb-3 equipe-row">
                        <div class="col-md-5">
                            <label>Personnels</label>
                            <select name="personnel_id[]" class="form-select personnel-select">
                                ${personnelOptions}
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>Temps</label>
                            <input type="text" name="temps[]" class="form-control">
                            <div class="invalid-feedback">Ce champ est requis</div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm removeRowBtn"><i
                                    data-feather="trash-2"></i>&thinsp;&thinsp; Supprimer</button>
                        </div>
                    </div>
                `;

                $('#equipeContainer').append(newRow);

                // Réinitialiser les icônes Feather
                refreshFeatherIcons();
            });

            // Supprimer une ligne
            $(document).on('click', '.removeRowBtn', function() {
                // S'assurer qu'il reste au moins une ligne
                if ($('.equipe-row').length > 1) {
                    $(this).closest('.equipe-row').remove();
                } else {
                    alert('Vous devez conserver au moins un membre dans l\'équipe.');
                }
            });

            // Réinitialiser les icônes au chargement
            refreshFeatherIcons();
        });
    </script>
@endsection
