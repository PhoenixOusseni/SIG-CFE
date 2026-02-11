@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Prestation</title>
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
                                Liste des prestations
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
                <div class="card-header">Ajouter une nouvelle prestation</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif

                    <form action="{{ route('module_base_taxable.store') }}" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Code prestation</label>
                                <input class="form-control" name="code" type="text" value="{{ Request::old('code') }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Nom de la prestation</label>
                                <input class="form-control" name="libelle" type="text" value="{{ Request::old('libelle') }}" required />
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Réference</label>
                                <input class="form-control" name="reference" type="text" value="{{ Request::old('reference') }}" required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Prix de la prestation</label>
                                <input class="form-control" name="prix" type="number" value="{{ Request::old('prix') }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Département</label>
                                <select name="familles_id" class="form-select" required>
                                    <option value="">Selectionner un département</option>
                                    @foreach ($familles as $famille)
                                        <option value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                                    @endforeach
                                </select>
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
                                                <h2 class="h4 mb-0">Liste des prestations</h2>
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
                                                            <th class="text-center">Prestation</th>
                                                            <th class="text-center">Réference</th>
                                                            <th class="text-center">Prix de la prestation</th>
                                                            <th class="text-center">Département</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>{{ $item->libelle }}</td>
                                                                <td>{{ $item->reference }}</td>
                                                                <td>{{ $item->prix }}</td>
                                                                <td>{{ $item->Famille->libelle }}</td>
                                                                <td class="d-flex align-items-center justify-content-center">
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editPrestationModal{{ $item->id }}" class="me-2">
                                                                        <i class="fa fa-edit text-warning" aria-hidden="true"></i>
                                                                    </a>
                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deletePrestationModal{{ $item->id }}">
                                                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>

                                                            <!-- Modal de modification -->
                                                            <div class="modal fade" id="editPrestationModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning">
                                                                            <h5 class="modal-title text-white" id="editModalLabel">Modifier la prestation</h5>
                                                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('module_base_taxable.update', [$item->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Code prestation</label>
                                                                                    <input class="form-control" name="code" type="text" value="{{ $item->id }}" disabled />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Nom de la prestation</label>
                                                                                    <input class="form-control" name="libelle" type="text" value="{{ $item->libelle }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Réference</label>
                                                                                    <input class="form-control" name="reference" type="text" value="{{ $item->reference }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Prix de la prestation</label>
                                                                                    <input class="form-control" name="prix" type="number" value="{{ $item->prix }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="small mb-1">Département</label>
                                                                                    <select name="familles_id" class="form-select" required>
                                                                                        @foreach ($familles as $famille)
                                                                                            <option value="{{ $famille->id }}" {{ $item->familles_id == $famille->id ? 'selected' : '' }}>{{ $famille->libelle }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <!-- Save changes button-->
                                                                                <button class="btn btn-warning text-white" type="submit">
                                                                                    <i class="fas fa-save"></i>&nbsp; Enregistrer les modifications
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal de suppression -->
                                                            <div class="modal fade" id="deletePrestationModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                                                Êtes-vous sûr de vouloir supprimer la prestation <strong>{{ $item->libelle }}</strong> ?
                                                                            </p>
                                                                            <p class="text-center text-muted">
                                                                                Cette action est irréversible et supprimera également tous les éléments associés à cette prestation.
                                                                            </p>
                                                                        </div>
                                                                        <div class="m-3">
                                                                            <form action="{{ route('module_base_taxable.destroy', [$item->id]) }}" method="POST" style="display: inline;">
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
