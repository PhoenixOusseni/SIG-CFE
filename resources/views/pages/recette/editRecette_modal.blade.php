<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light" id="exampleModalLabel">Ordre de recette N°{{ $recette->id }}</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_ordre_recette.update', [$recette->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card card-default">
                        <div class="card-body">
                            <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Budget</label>
                                            <select name="budgets_id" class="form-select">
                                                <option value="{{ $recette->Budget->id }}">
                                                    {{ $recette->Budget->libelle }}</option>
                                                @foreach ($budgets as $budget)
                                                    <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Contribuable</label>
                                            <select name="contribuables_id" class="form-select">
                                                <option value="{{ $recette->Contribuable->id }}">
                                                    {{ $recette->Contribuable->assujeti }}</option>
                                                @foreach ($contribuables as $contribuable)
                                                    <option value="{{ $contribuable->id }}">
                                                        {{ $contribuable->assujeti }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Echeance de paiement</label>
                                            <input class="form-control" name="echeance" type="date"
                                                value="{{ $recette->echeance }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Objet</label>
                                            <input class="form-control" name="objet" type="text"
                                                value="{{ $recette->objet }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Date</label>
                                            <input class="form-control" name="date" type="date"
                                                value="{{ $recette->date }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Période debut</label>
                                            <input class="form-control" name="periode_debut" type="date"
                                                value="{{ $recette->periode_debut }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Période fin</label>
                                            <input class="form-control" name="periode_fin" type="date"
                                                value="{{ $recette->periode_fin }}" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="m-3">
                            <button class="btn btn-1" type="submit">
                                <i class="fas fa-edit"></i>
                                &nbsp; &nbsp; Modifier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
