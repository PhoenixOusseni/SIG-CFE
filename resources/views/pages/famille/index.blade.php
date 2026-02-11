@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Departement</title>
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
                                Liste des départements
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
                <div class="card-header">Ajouter un nouveau département</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    <form action="{{ route('module_famille.store') }}" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Code département</label>
                                <input class="form-control" name="code" type="text" value="{{ Request::old('code') }}"
                                    required />
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Taux (%)</label>
                                <input class="form-control" name="taux" type="number" value="{{ Request::old('taux') }}"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Nom département</label>
                                <input class="form-control" name="libelle" type="text"
                                    value="{{ Request::old('libelle') }}" required />
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
                                            <div class="d-flex justify-content-between mb-3">
                                                <h2 class="h4 mb-0">Liste des departements</h2>
                                                <div>
                                                    <input type="text" placeholder="Rechercher..." class="form-control"
                                                        id="searchInput" onkeyup="searchTable()">
                                                </div>
                                            </div>
                                            <div class="sbp-preview-content">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Code</th>
                                                            <th class="text-center">Libellé</th>
                                                            <th class="text-center">Taux (%)</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>{{ $item->libelle }}</td>
                                                                <td>{{ $item->taux }}</td>
                                                                <td
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#editFamilleModal{{ $item->id }}">
                                                                        <i class="fa fa-edit text-warning mx-2" aria-hidden="true"></i>
                                                                    </a>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteFamilleModal{{ $item->id }}">
                                                                        <i class="fa fa-trash text-danger mx-2" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>

                                                            <!-- edit modal -->
                                                            <div class="modal fade"
                                                                id="editFamilleModal{{ $item->id }}" tabindex="-1"
                                                                aria-labelledby="editFamilleModalLabel{{ $item->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="editFamilleModalLabel{{ $item->id }}">Modifier le département N°{{ $item->id }}</h5>
                                                                            <button type="button" class="btn-close text-dark"
                                                                                data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('module_famille.update', $item->id) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Code département</label>
                                                                                    <input class="form-control" name="code" type="text" value="{{ $item->id }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Taux (%)</label>
                                                                                    <input class="form-control" name="taux" type="number" value="{{ $item->taux }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Nom département</label>
                                                                                    <input class="form-control" name="libelle" type="text" value="{{ $item->libelle }}" required />
                                                                                </div>
                                                                                <button type="submit" class="btn btn-1">
                                                                                    <i class="fas fa-save"></i>&nbsp; Enregistrer la modification
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- delete modal -->
                                                            <div class="modal fade"
                                                                id="deleteFamilleModal{{ $item->id }}" tabindex="-1"
                                                                aria-labelledby="deleteFamilleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteFamilleModalLabel{{ $item->id }}">
                                                                                Confirmer la suppression</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Êtes-vous sûr de vouloir supprimer ce
                                                                            département ?
                                                                        </div>
                                                                        <div class="m-3">
                                                                            <form
                                                                                action="{{ route('module_famille.destroy', $item->id) }}"
                                                                                method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Supprimer</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Annuler</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
    </main>
@endsection
