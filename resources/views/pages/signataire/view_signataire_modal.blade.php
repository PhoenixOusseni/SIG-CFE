
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $signataire->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Information de l'entete</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_signataire.update', [$signataire->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <img src="{{ asset('storage') . '/' . $signataire->photo }}" class="w-25" alt="logo entete">
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Nom signataire</label>
                                <input class="form-control" name="nom" value="{{ $signataire->nom }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Fonction</label>
                                <input class="form-control" name="fonction" value="{{ $signataire->fonction }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-edit"></i>
                            &nbsp; &nbsp;Modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
