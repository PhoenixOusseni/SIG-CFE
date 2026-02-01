<!-- Modal de suppression -->
<div class="modal fade" id="deleteRecetteModal{{ $recette->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fa fa-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="text-center">
                    Êtes-vous sûr de vouloir supprimer la recette <strong>{{ $recette->code }}</strong> ?
                </p>
                <p class="text-center text-muted">
                    Cette action est irréversible et supprimera également tous les éléments associés à cette recette.
                </p>
            </div>
            <div class="m-3">
                <form action="{{ route('module_ordre_recette.destroy', [$recette->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>&nbsp; Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
