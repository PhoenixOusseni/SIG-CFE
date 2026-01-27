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
                            <fieldset class="w-100 p-3 mb-3"
                                style="border-radius: 5px; background: rgb(234, 233, 233); border: 1px solid #ddd;">
                                <legend class="w-auto px-2" style="font-size: 1rem; font-weight: bold;">Informations
                                    générales</legend>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Client <span class="text-danger">*</span></label>
                                            <select name="contribuables_id" class="form-select" required>
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
                                            <label class="small mb-1">Signataire <span
                                                    class="text-danger">*</span></label>
                                            <select name="signataires_id" class="form-select" required>
                                                <option value="">Sélectionner le signataire</option>
                                                @foreach (App\Models\Signataire::all() as $signataire)
                                                    <option value="{{ $signataire->id }}"
                                                        {{ $recette->signataires_id == $signataire->id ? 'selected' : '' }}>
                                                        {{ $signataire->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Service <span class="text-danger">*</span></label>
                                            <select name="service_id" class="form-select" required>
                                                <option value="">Sélectionner le service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        {{ $recette->service_id == $service->id ? 'selected' : '' }}>
                                                        {{ $service->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Échéance</label>
                                            <input class="form-control" name="echeance" type="date"
                                                value="{{ $recette->echeance }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Désignation / Objet <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="objet" type="text"
                                                value="{{ $recette->objet }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Marché <span class="text-danger">*</span></label>
                                            <select name="marche_id" class="form-select" required>
                                                <option value="">Sélectionner le marché</option>
                                                @foreach (App\Models\Marche::all() as $marche)
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
                                            <label class="small mb-1">Période début</label>
                                            <input class="form-control" name="periode_debut" type="date"
                                                value="{{ $recette->periode_debut }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Période fin</label>
                                            <input class="form-control" name="periode_fin" type="date"
                                                value="{{ $recette->periode_fin }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Département</label>
                                            <select name="categorie_id" class="form-select">
                                                <option value="">Sélectionner le département</option>
                                                @foreach (App\Models\Categorie::all() as $departement)
                                                    <option value="{{ $departement->id }}"
                                                        {{ $recette->categorie_id == $departement->id ? 'selected' : '' }}>
                                                        {{ $departement->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="w-100 p-3 mt-3"
                                style="border-radius: 5px; background: rgb(219, 238, 221); border: 1px solid #ddd;">
                                <legend class="w-auto px-2" style="font-size: 1rem; font-weight: bold;">Éléments de la
                                    facture</legend>
                                <div id="elementsEditContainer">
                                    @if ($elements->count() > 0)
                                        @foreach ($elements as $index => $element)
                                            <div class="row mb-3 element-edit-row"
                                                data-element-id="{{ $element->id }}">
                                                <input type="hidden" name="element_id[]"
                                                    value="{{ $element->id }}">
                                                <div class="col-lg-4 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Désignation</label>
                                                        <select class="form-select base-taxable-select"
                                                            name="base_taxables_id[]">
                                                            <option value="">Sélectionner la désignation</option>
                                                            @foreach ($bases as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $element->base_taxables_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->libelle }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Quantité</label>
                                                        <input class="form-control" name="quantite[]" type="number"
                                                            value="{{ $element->quantite }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Prix unitaire</label>
                                                        <input class="form-control" name="prix_unitaire[]"
                                                            type="number" value="{{ $element->prix_unitaire }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Unité</label>
                                                        <input class="form-control" name="unite[]" type="text"
                                                            value="{{ $element->unite }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 d-flex align-items-end">
                                                    <div class="mb-3">
                                                        @if ($index == 0)
                                                            <button type="button" class="btn btn-success btn-sm me-2"
                                                                id="addEditRowBtn">
                                                                <i data-feather="plus"></i>&thinsp; Ajouter
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm removeEditRowBtn">
                                                                <i data-feather="trash-2"></i>&thinsp; Supprimer
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row mb-3 element-edit-row">
                                            <input type="hidden" name="element_id[]" value="">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Désignation</label>
                                                    <select class="form-select base-taxable-select"
                                                        name="base_taxables_id[]">
                                                        <option value="">Sélectionner la désignation</option>
                                                        @foreach ($bases as $item)
                                                            <option value="{{ $item->id }}">{{ $item->libelle }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Quantité</label>
                                                    <input class="form-control" name="quantite[]" type="number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Prix unitaire</label>
                                                    <input class="form-control" name="prix_unitaire[]"
                                                        type="number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <div class="mb-3">
                                                    <label class="small mb-1">Unité</label>
                                                    <input class="form-control" name="unite[]" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2 d-flex align-items-end">
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-success btn-sm me-2"
                                                        id="addEditRowBtn">
                                                        <i data-feather="plus"></i>&thinsp; Ajouter
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
                        <button class="btn btn-warning" type="submit">
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
            <option value="">Sélectionner la désignation</option>
            @foreach ($bases as $item)
                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
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
                    <div class="col-lg-4 col-md-12">
                        <div class="mb-3">
                            <label class="small mb-1">Désignation</label>
                            <select class="form-select base-taxable-select" name="base_taxables_id[]">
                                ${baseOptionsEdit}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-3">
                            <label class="small mb-1">Quantité</label>
                            <input class="form-control" name="quantite[]" type="number" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-3">
                            <label class="small mb-1">Prix unitaire</label>
                            <input class="form-control" name="prix_unitaire[]" type="number" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="mb-3">
                            <label class="small mb-1">Unité</label>
                            <input class="form-control" name="unite[]" type="text" />
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger btn-sm removeEditRowBtn">
                                <i data-feather="trash-2"></i>&thinsp; Supprimer
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
