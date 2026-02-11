@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Liste des projets</title>
@endsection

@section('style')
    @include('partials.style')
@endsection

@section('content')
    <header class="page-header page-header-dark header-gradient pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            Liste des projets
                        </h1>
                    </div>
                    <div class="col-auto mt-4">
                        <a href="{{ route('gestion_marche.create') }}" class="btn btn-light"><i
                                data-feather="plus"></i>&thinsp;&thinsp;
                            Ajouter un projet</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->

    <div class="container-xl px-4 mt-n10">
        <!-- Example Charts for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h2 class="h4 mb-0">Liste des projets</h2>
                            <div>
                                <input type="text" placeholder="Rechercher..." class="form-control" id="searchInput"
                                    onkeyup="searchTable()">
                            </div>
                        </div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Date début</th>
                                    <th>Date cloture</th>
                                    <th>Client</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marches as $marche)
                                    <tr>
                                        <td>{{ $marche->id }}</td>
                                        <td>{{ $marche->code }}</td>
                                        <td>{{ $marche->designation }}</td>
                                        <td>{{ $marche->date_debut }}</td>
                                        <td>{{ $marche->date_cloture }}</td>
                                        <td>{{ $marche->contribuable->assujeti }}</td>
                                        <td class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('gestion_marche.show', $marche->id) }}">
                                                <i class="me-2 text-green" data-feather="eye"></i>
                                            </a>
                                            <a href="{{ route('gestion_marche.edit', $marche->id) }}">
                                                <i class="me-2 text-warning" data-feather="edit"></i>
                                            </a>
                                            <form action="{{ route('gestion_marche.destroy', $marche->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 m-0 align-self-center">
                                                    <i class="text-red" data-feather="trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $marches->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
