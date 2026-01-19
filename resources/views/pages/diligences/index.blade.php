@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Gestion des diligences</title>
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
                            Liste des diligences
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
                            <a href="{{ route('gestion_diligence.create') }}" class="btn btn-light"><i
                                    data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter une diligence</a>
                            <a href="{{ route('gestion_diligence.index') }}" class="btn btn-light"><i
                                    data-feather="align-left"></i>&thinsp;&thinsp;
                                Liste des diligences</a>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Taux</th>
                                    <th>Personnel</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diligences as $diligence)
                                    <tr>
                                        <td>{{ $diligence->id }}</td>
                                        <td>{{ $diligence->code }}</td>
                                        <td>{{ $diligence->designation }}</td>
                                        <td>{{ $diligence->taux }}</td>
                                        <td>{{ $diligence->personnel->nom ?? 'N/A' }}
                                            {{ $diligence->personnel->prenom ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <a class="text-center"
                                                href="{{ route('gestion_diligence.show', $diligence->id) }}">
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
