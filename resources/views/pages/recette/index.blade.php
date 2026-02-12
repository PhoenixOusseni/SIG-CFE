@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Facturation</title>
@endsection

@section('style')
    @include('partials.style')
@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark header-gradient pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Gestion des factures
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Ajouter une facture</div>
                <div class="card-body">

                    <form action="{{ route('module_ordre_recette.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <input class="form-control" name="statut" type="text" value="en attente" hidden />
                                        <input class="form-control" name="users_id" type="text" value="{{ Auth::user()->id }}" hidden />
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Client</label>
                                                <select name="contribuables_id" class="form-select">
                                                    <option value="">Sélectionner le client</option>
                                                    @foreach ($contribuables as $contribuable)
                                                        <option value="{{ $contribuable->id }}">
                                                            {{ $contribuable->assujeti }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Categorie</label>
                                                <select name="categorie_id" class="form-select">
                                                    <option>Sélectionner la catégorie</option>
                                                    @foreach (App\Models\Categorie::all() as $categorie)
                                                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Signataire ({{ Auth::user()->login }})</label>
                                                <input type="text" name="users_id" class="form-control" value="{{ Auth::user()->id }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Echeance de paiement</label>
                                                <input class="form-control" type="date" name="echeance" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Code</label>
                                                <input class="form-control" name="code" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Référence</label>
                                                <input class="form-control" name="reference" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Projet</label>
                                                <select name="marche_id" class="form-select">
                                                    <option value="">Sélectionner le Projet</option>
                                                    @foreach ($marches as $marche)
                                                        <option value="{{ $marche->id }}">
                                                            {{ $marche->designation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date</label>
                                                <input class="form-control" name="date" type="date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Département</label>
                                                <select name="service_id" class="form-select" required>
                                                    <option value="">Sélectionner le département</option>
                                                    @foreach (App\Models\Service::all() as $service)
                                                        <option value="{{ $service->id }}">
                                                            {{ $service->libelle }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: rgb(219, 238, 221)">
                                    <h5 class="mb-3 text-success">Éléments de la facture</h5>
                                    <div id="elementsContainer">
                                        <div class="row mb-3 element-row">
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Compte</label>
                                                    <select class="form-select base-taxable-select" name="base_taxables_id[]">
                                                        <option value="">Sélectionner un compte</option>
                                                        @foreach ($bases as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->libelle }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Designation</label>
                                                    <input class="form-control" name="designation[]" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Quantité</label>
                                                    <input class="form-control" name="quantite[]" type="number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Prix unitaire</label>
                                                    <input class="form-control" name="prix_unitaire[]" type="number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-1 d-flex align-items-end">
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-success btn-sm me-2" id="addRowBtn"><i
                                                        data-feather="plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-1" type="submit">
                                    <i class="fas fa-save"></i>
                                    &nbsp; &nbsp; Enregistrer la facture
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tabbed dashboard card example-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Tabbed dashboard card example-->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h2 class="h4 mb-0">Liste des factures</h2>
                                                <div>
                                                    <input type="text" placeholder="Rechercher..." class="form-control"
                                                        id="searchInput" onkeyup="searchTable()">
                                                </div>
                                            </div>
                                            <div class="sbp-preview-content">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Reference</th>
                                                            <th>Client</th>
                                                            <th>Marché</th>
                                                            <th>Echeance</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $recette)
                                                            <tr>
                                                                <td>{{ $recette->code }}</td>
                                                                <td>{{ $recette->reference }}</td>
                                                                <td>{{ $recette->Contribuable->assujeti }}</td>
                                                                <td>{{ $recette->Marche->designation ?? 'N/A' }}</td>
                                                                <td>{{ $recette->echeance }}</td>
                                                                <td class="d-flex justify-content-center">
                                                                    <a href="{{ route('module_ordre_recette.show', [$recette->id]) }}">
                                                                        <i class="fa fa-eye text-success" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @include('pages.recette.view_recette_modal')
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $collection->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Variable pour stocker le HTML des options de base taxable
            let baseOptions = `
                <option value="">Sélectionner un compte</option>
                @foreach ($bases as $item)
                    <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->libelle }}</option>
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
                    <div class="row mb-3 element-row">
                        <div class="col-lg-3 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Compte</label>
                                <select class="form-select base-taxable-select" name="base_taxables_id[]">
                                    ${baseOptions}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Designation</label>
                                <input class="form-control" name="designation[]" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Quantité</label>
                                <input class="form-control" name="quantite[]" type="number" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Prix unitaire</label>
                                <input class="form-control" name="prix_unitaire[]" type="number" />
                            </div>
                        </div>
                        <div class="col-lg-1 d-flex align-items-end">
                            <div class="mb-3">
                                <button type="button" class="btn btn-danger btn-sm removeRowBtn"><i
                                        data-feather="trash-2"></i></button>
                            </div>
                        </div>
                    </div>
                `;

                $('#elementsContainer').append(newRow);

                // Réinitialiser les icônes Feather
                refreshFeatherIcons();
            });

            // Supprimer une ligne
            $(document).on('click', '.removeRowBtn', function() {
                // S'assurer qu'il reste au moins une ligne
                if ($('.element-row').length > 1) {
                    $(this).closest('.element-row').remove();
                } else {
                    alert('Vous devez conserver au moins un élément dans la facture.');
                }
            });

            // Réinitialiser les icônes au chargement
            refreshFeatherIcons();
        });
    </script>
@endsection
