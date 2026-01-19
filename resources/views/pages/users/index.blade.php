@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Entete</title>
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
                                Gestion des utilisateurs
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
                <div class="card-header">Ajouter un nouveau utilisateur</div>
                <div class="card-body">
                    <form action="{{ route('module_utilisateur.store') }}" method="POST">
                        @csrf
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Nom</label>
                                            <input class="form-control" name="nom" type="text" placeholder="Henry" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Prénom</label>
                                            <input class="form-control" name="prenom" type="text" placeholder="Mitchel" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Email</label>
                                            <input class="form-control" name="email" type="email" placeholder="utilisateur@exemple.com" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Role utilisateur</label>
                                            <select class="form-select" name="role" required>
                                                <option value="">Selectionner ici...</option>
                                                <option value="Administrateur">Administrateur</option>
                                                <option value="Superviseur">Superviseur</option>
                                                
                                                {{-- Emmet oredre de rectte DSCRE --}}
                                                <option value="DAF">DAF</option>
                                                <option value="Comptable">Comptable</option>
                                                <option value="Controle">Controle</option>
                                                {{-- Volume d'eau prelevé --}}
                                                <option value="DSCRE">DSCRE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1">Activation</label>
                                            <select class="form-select" name="activate" required>
                                                <option>Selectionner ici...</option>
                                                <option value="1">Activer</option>
                                                <option value="0">Desactiver</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-1" type="submit">
                                    <i class="fas fa-save"></i>
                                    &nbsp; &nbsp;Enregistrer
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
                                            <div class="sbp-preview-content">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Nom</th>
                                                            <th>Prénom</th>
                                                            <th>Login</th>
                                                            <th>Role</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($collection as $item)
                                                        <tr>
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->nom }}</td>
                                                            <td>{{ $item->prenom }}</td>
                                                            <td>{{ $item->login }}</td>
                                                            <td>{{ $item->role }}</td>
                                                            <td class="d-flex justify-content-center">
                                                                <a href="{{ route ('module_utilisateur.show', [$item->id]) }}">
                                                                    <i class="fa fa-eye text-success" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
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
