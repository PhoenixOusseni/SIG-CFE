@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Categories</title>
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
                                Liste des categories
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
                <div class="card-header">Ajouter une nouvelle catégorie</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div> <br>
                    @endif

                    <form action="{{ route('module_categorie.store') }}" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Categorie</label>
                                <input class="form-control" name="libelle" id="inputFirstName" type="text"
                                    placeholder="Nom de la catégorie" value="{{ Request::old('libelle') }}" required />
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-save"></i>
                            &nbsp; &nbsp; Enregistrer
                        </button>
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
                                            <div class="sbp-preview-content">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Code</th>
                                                            <th class="text-center">Libellé</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>{{ $item->libelle }}</td>
                                                                <td class="d-flex align-items-center justify-content-center">
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCategorieModal{{ $item->id }}">
                                                                        <i class="fa fa-trash text-danger mx-2" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>

                                                            <!-- Modal de suppression -->
                                                            <div class="modal fade" id="deleteCategorieModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                                                Êtes-vous sûr de vouloir supprimer la catégorie <strong>{{ $item->libelle }}</strong> ?
                                                                            </p>
                                                                            <p class="text-center text-muted">
                                                                                Cette action est irréversible et supprimera également tous les éléments associés à cette catégorie.
                                                                            </p>
                                                                        </div>
                                                                        <div class="m-3">
                                                                            <form action="{{ route('module_categorie.destroy', [$item->id]) }}" method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">
                                                                                    <i class="fas fa-trash"></i>&nbsp; Supprimer
                                                                                </button>
                                                                            </form>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                                <i class="fas fa-times"></i>&nbsp; Annuler
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
