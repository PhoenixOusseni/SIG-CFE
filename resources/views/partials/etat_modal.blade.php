
{{-- Etat budget dépenses --}}
<div class="modal fade" id="etatBudgetDepense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-content">
        <form action="{{ route('etat_budget_depense') }}" method="GET">
            <div class="modal-header bg-success text-white">
                <h5 class="card-title" id="exampleModalLabel">Etat budgetaire des dépenses</h5>
                <button type="button" class="close text-white" data-dismiss="modal">X</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="col-md-1">Du</label>
                            <input type="date" class="form-control" name="date_debut" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-md-1">Au</label>
                            <input type="date" class="form-control" name="date_fin" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="col-md-12">Budget dépense</label>
                            <select name="budgets_id" class="form-control">
                                @foreach (App\Models\Budget::where('type', 'Dépense')->get() as $budget)
                                    <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3">
                <button class="btn btn-1" type="submit">Afficher</button>
                <a href="{{ route('etat_tous_budget') }}" class="btn btn-1">Afficher tout</a>
            </div>
        </form>
    </div>
</div>


{{-- Etat budget recette --}}
<div class="modal fade" id="etatBudgetRecette" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-content">
        <form action="{{ route('etat_budget_recette') }}" method="GET">
            <div class="modal-header bg-success">
                <h5 class="card-title text-white" id="exampleModalLabel">Etat budgetaire des recettes</h5>
                <button type="button" class="close text-white" data-dismiss="modal">X</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="col-md-1">Du</label>
                            <input type="date" class="form-control" name="date_debut" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-md-1">Au</label>
                            <input type="date" class="form-control" name="date_fin" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="col-md-12">Budget recette</label>
                            <select name="budgets_id" class="form-control">
                                @foreach (App\Models\Budget::where('type', 'Recette')->get() as $budget)
                                    <option value="{{ $budget->id }}">{{ $budget->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3">
                <button class="btn btn-1" type="submit">Afficher</button>
                <a href="{{ route('etat_tous_budget_recette') }}" class="btn btn-1">Afficher tout</a>
            </div>
        </form>
    </div>
</div>
