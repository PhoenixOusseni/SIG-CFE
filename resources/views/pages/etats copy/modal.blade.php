<!-- Add entete -->
<div class="modal fade" id="addEntete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une entete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{ route('gestion_entete.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="small mb-1">Titre</label>
                                    <input class="form-control" type="text" name="titre"
                                        placeholder="Entrer le titre" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="small mb-1">Sous-titre</label>
                                    <input class="form-control" type="text" name="sous_titre"
                                        placeholder="Entrer le sous-titre" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="small mb-1">Adresse</label>
                                    <input class="form-control" type="text" name="adresse"
                                        placeholder="Entrer l'adresse" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="small mb-1">Téléphone</label>
                                    <input class="form-control" type="text" name="telephone"
                                        placeholder="Entrer le téléphone" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Logo</label>
                                    <input class="form-control" type="file" name="logo" />
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4 mb-0"><button class="btn btn-dark btn-block" type="submit">Enregistrer
                                l'entête</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
