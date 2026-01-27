@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Liste des personnels</title>
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
                            Liste des personnels
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
                            <a href="{{ route('gestion_personnel.create') }}" class="btn btn-light"><i
                                    data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter un personnel</a>
                            <a href="{{ route('gestion_personnel.index') }}" class="btn btn-light"><i
                                    data-feather="align-left"></i>&thinsp;&thinsp;
                                Liste des personnels</a>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personnels as $personnel)
                                    <tr>
                                        <td>{{ $personnel->id }}</td>
                                        <td>{{ $personnel->code }}</td>
                                        <td>{{ $personnel->nom }}</td>
                                        <td>{{ $personnel->prenom }}</td>
                                        <td>{{ $personnel->email }}</td>
                                        <td>{{ $personnel->telephone }}</td>
                                        <td class="text-center">
                                            <a class="text-center"
                                                href="{{ route('gestion_personnel.show', $personnel->id) }}">
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
