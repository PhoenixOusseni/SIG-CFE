@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Fournisseur</title>
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
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Gestion des fournisseurs
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
                <div class="card-header">Ajouter un nouveau fournisseur</div>
                <div class="card-body">
                    <form action="{{ route('module_fornisseur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Désignation</label>
                                            <input class="form-control" name="libelle" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Adresse</label>
                                            <input class="form-control" name="adresse" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">N° Téléphone</label>
                                            <input class="form-control" name="telephone" type="number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">N° IFU</label>
                                            <input class="form-control" name="ifu" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">RCCM</label>
                                            <input class="form-control" name="rccm" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-1" type="submit">
                                    <i class="fas fa-save"></i>
                                    &nbsp; &nbsp; Enregistrer
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
                                                <h2 class="h4 mb-0">Liste des fournisseurs</h2>
                                                <div>
                                                    <input type="text" placeholder="Rechercher..." class="form-control"
                                                        id="searchInput" onkeyup="searchTable()">
                                                </div>
                                            </div>
                                            <div class="sbp-preview-content">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Désignation</th>
                                                            <th>Adresse</th>
                                                            <th>N° IFU</th>
                                                            <th>Téléphone</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $fournisseur)
                                                            <tr>
                                                                <td>{{ $fournisseur->id }}</td>
                                                                <td>{{ $fournisseur->libelle }}</td>
                                                                <td>{{ $fournisseur->adresse }}</td>
                                                                <td>{{ $fournisseur->ifu }}</td>
                                                                <td>{{ $fournisseur->telephone }}</td>
                                                                <td class="d-flex gap-3">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#enteteModal{{ $fournisseur->id }}">
                                                                        <i class="fa fa-edit text-warning"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteFournisseurModal{{ $fournisseur->id }}">
                                                                        <i class="fa fa-trash text-danger"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal de suppression -->
                                                            <div class="modal fade"
                                                                id="deleteFournisseurModal{{ $fournisseur->id }}"
                                                                tabindex="-1" aria-labelledby="deleteModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger">
                                                                            <h5 class="modal-title text-white"
                                                                                id="deleteModalLabel">Confirmation de
                                                                                suppression</h5>
                                                                            <button type="button"
                                                                                class="btn-close text-white"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="text-center mb-3">
                                                                                <i class="fa fa-exclamation-triangle text-danger"
                                                                                    style="font-size: 3rem;"></i>
                                                                            </div>
                                                                            <p class="text-center">
                                                                                Êtes-vous sûr de vouloir supprimer le
                                                                                fournisseur<strong>{{ $fournisseur->nom }}</strong>?
                                                                            </p>
                                                                            <p class="text-center text-muted">
                                                                                Cette action est irréversible et supprimera
                                                                                également tous les éléments associés à ce
                                                                                fournisseur.
                                                                            </p>
                                                                        </div>
                                                                        <div class="m-3">
                                                                            <form
                                                                                action="{{ route('module_fornisseur.destroy', [$fournisseur->id]) }}"
                                                                                method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">
                                                                                    <i class="fas fa-trash"></i>&nbsp;
                                                                                    Supprimer
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @include('pages.fournisseur.view_fournisseur_modal')
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
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
        </div>
    </main>
@endsection
