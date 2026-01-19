
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $entete->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Information de l'entete</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_entete.update', [$entete->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <img src="{{ asset('storage') . '/' . $entete->logo }}" class="w-25" alt="logo entete">
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Dénomination</label>
                                <input class="form-control" name="denomination" value="{{ $entete->denomination }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Activité</label>
                                <input class="form-control" name="activite" value="{{ $entete->activite }}"
                                    type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Boite postale</label>
                                <input class="form-control" name="postale" value="{{ $entete->postale }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Téléphone</label>
                                <input class="form-control" name="telephone" value="{{ $entete->telephone }}"
                                    type="number" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Fax</label>
                                <input class="form-control" name="fax" value="{{ $entete->fax }}" type="number" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">E-mail</label>
                                <input class="form-control" name="email" value="{{ $entete->email }}" type="email" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Pied de page</label>
                                <input class="form-control" name="pied_page" value="{{ $entete->pied_page }}"
                                    type="text" />
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
