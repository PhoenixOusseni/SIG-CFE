<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark" id="exampleModalLabel">
                    Modifier la facture n° FAC0{{ $recette->id }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_ordre_recette.update', [$recette->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card card-default">
                        <div class="card-body">
                            <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                <div class="row">
                                    <input class="form-control" name="statut" type="text" value="{{ $recette->statut }}" hidden />
                                    <input class="form-control" name="users_id" type="text" value="{{ Auth::user()->id }}" hidden />
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Client</label>
                                            <select name="contribuables_id" class="form-select">
                                                <option value="">Sélectionner le client</option>
                                                @foreach ($contribuables as $contribuable)
                                                    <option value="{{ $contribuable->id }}"
                                                        {{ $recette->contribuables_id == $contribuable->id ? 'selected' : '' }}>
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
                                                    <option value="{{ $categorie->id }}"
                                                        {{ $recette->categorie_id == $categorie->id ? 'selected' : '' }}>
                                                        {{ $categorie->libelle }}
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
                                            <input class="form-control" type="date" name="echeance" value="{{ $recette->echeance }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Code</label>
                                            <input class="form-control" name="code" type="text" value="{{ $recette->code }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Référence</label>
                                            <input class="form-control" name="reference" type="text" value="{{ $recette->reference }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Projet</label>
                                            <select name="marche_id" class="form-select">
                                                <option value="">Sélectionner le Projet</option>
                                                @foreach ($marches as $marche)
                                                    <option value="{{ $marche->id }}"
                                                        {{ $recette->marche_id == $marche->id ? 'selected' : '' }}>
                                                        {{ $marche->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Date</label>
                                            <input class="form-control" name="date" type="date" value="{{ $recette->date }}" />
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
                                                    <option value="{{ $service->id }}"
                                                        {{ $recette->service_id == $service->id ? 'selected' : '' }}>
                                                        {{ $service->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="w-100 p-2 mt-3" style="border-radius: 5px; background: #bdcff2;">
                                <h5 class="mb-3 text-primary">Éléments de la facture</h5>
                                <div id="elementsEditContainer">
                                    @if ($elements->count() > 0)
                                        @foreach ($elements as $index => $element)
                                            <div class="row mb-3 element-edit-row"
                                                data-element-id="{{ $element->id }}">
                                                <input type="hidden" name="element_id[]"
                                                    value="{{ $element->id }}">
                                                <div class="col-lg-3 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Compte</label>
                                                        <select class="form-select base-taxable-select"
                                                            name="base_taxables_id[]">
                                                            <option value="">Sélectionner un compte</option>
                                                            @foreach ($bases as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $element->base_taxables_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->code }} - {{ $item->libelle }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Designation</label>
                                                        <input class="form-control" name="designation[]" type="text"
                                                            value="{{ $element->designation }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Quantité</label>
                                                        <input class="form-control" name="quantite[]" type="number"
                                                            value="{{ $element->quantite }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Prix unitaire</label>
                                                        <input class="form-control" name="prix_unitaire[]"
                                                            type="number" value="{{ $element->prix_unitaire }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 d-flex align-items-end">
                                                    <div class="mb-3">
                                                        @if ($index == 0)
                                                            <button type="button" class="btn btn-1 btn-sm me-2"
                                                                id="addEditRowBtn">
                                                                <i data-feather="plus"></i>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm removeEditRowBtn">
                                                                <i data-feather="trash-2"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row mb-3 element-edit-row">
                                            <input type="hidden" name="element_id[]" value="">
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Compte</label>
                                                    <select class="form-select base-taxable-select"
                                                        name="base_taxables_id[]">
                                                        <option value="">Sélectionner un compte</option>
                                                        @foreach ($bases as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->libelle }}
                                                            </option>
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
                                                    <input class="form-control" name="prix_unitaire[]"
                                                        type="number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-1 d-flex align-items-end">
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-primary btn-sm me-2"
                                                        id="addEditRowBtn">
                                                        <i data-feather="plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-1" type="submit">
                            <i data-feather="save"></i>&thinsp; Enregistrer les modifications
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i data-feather="x"></i>&thinsp; Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Réinitialiser les icônes Feather après l'ouverture du modal
    $('#editModal').on('shown.bs.modal', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });

    $(document).ready(function() {
        // Variable pour stocker le HTML des options de base taxable
        let baseOptionsEdit = `
            <option value="">Sélectionner un compte</option>
            @foreach ($bases as $item)
                <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->libelle }}</option>
            @endforeach
        `;

        // Fonction pour réinitialiser les icônes Feather
        function refreshFeatherIconsEdit() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Ajouter une nouvelle ligne dans le modal d'édition
        $(document).on('click', '#addEditRowBtn', function() {
            let newRow = `
                <div class="row mb-3 element-edit-row">
                    <input type="hidden" name="element_id[]" value="">
                    <div class="col-lg-3 col-md-12">
                        <div class="mb-3">
                            <label class="small mb-1">Compte</label>
                            <select class="form-select base-taxable-select" name="base_taxables_id[]">
                                ${baseOptionsEdit}
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
                            <button type="button" class="btn btn-danger btn-sm removeEditRowBtn">
                                <i data-feather="trash-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            $('#elementsEditContainer').append(newRow);

            // Réinitialiser les icônes Feather
            refreshFeatherIconsEdit();
        });

        // Supprimer une ligne dans le modal d'édition
        $(document).on('click', '.removeEditRowBtn', function() {
            // S'assurer qu'il reste au moins une ligne
            if ($('.element-edit-row').length > 1) {
                $(this).closest('.element-edit-row').remove();
            } else {
                alert('Vous devez conserver au moins un élément dans la facture.');
            }
        });
    });
</script>
