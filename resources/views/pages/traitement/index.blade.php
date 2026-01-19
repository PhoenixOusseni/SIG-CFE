@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Liste des traitements</title>
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
                            Liste des traitements
                        </h1>
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
                        <div class="col-sm-12 mb-3">
                            <a href="{{ route('gestion_traitement.create') }}" class="btn btn-light"><i data-feather="plus"></i>&thinsp;&thinsp;
                                Crée opérations</a>
                            <a href="{{ route('gestion_traitement.index') }}" class="btn btn-light"><i data-feather="align-left"></i>&thinsp;&thinsp;
                               Révu de qualité</a>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Date trait</th>
                                    <th>Désignation</th>
                                    <th>Critère</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($traitements as $traitement)
                                    <tr>
                                        <td>{{ $traitement->id }}</td>
                                        <td>{{ $traitement->code }}</td>
                                        <td>Du {{ $traitement->date_debut }} Au {{ $traitement->date_fin }}</td>
                                        <td>{{ $traitement->designation }}</td>
                                        <td>{{ $traitement->critere->code ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <a class="text-center" href="{{ route('gestion_traitement.show', $traitement->id) }}">
                                                <i class="me-2 text-green" data-feather="more-horizontal"></i>
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
@endsection
