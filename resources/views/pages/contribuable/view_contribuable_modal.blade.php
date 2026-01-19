
<!-- Modal -->
<div class="modal fade" id="enteteModal{{ $contribuable->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Information du contribuable</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module_contribuable.update', [$contribuable->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Assujeti</label>
                                <input class="form-control" name="assujeti" value="{{ $contribuable->assujeti }}" type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Adresse</label>
                                <input class="form-control" name="adresse" value="{{ $contribuable->adresse }}"
                                    type="text" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">N° IFU</label>
                                <input class="form-control" name="ifu" value="{{ $contribuable->ifu }}" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">Téléphone</label>
                                <input class="form-control" name="telephone" value="{{ $contribuable->telephone }}"
                                    type="number" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="mb-3">
                                <label class="small mb-1">RCCM</label>
                                <input class="form-control" name="rccm" value="{{ $contribuable->rccm }}" type="text" />
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
