@extends('layouts.master')
@section('title')
    <title>SIG - CFE | Ajouter un service</title>
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
                            <div class="page-header-icon"><i data-feather="plus-circle"></i></div>
                            Ajouter un service
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
                            <a href="{{ route('gestion_service.create') }}" class="btn btn-light"><i
                                    data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter un service</a>
                            <a href="{{ route('gestion_service.index') }}" class="btn btn-light"><i
                                    data-feather="align-left"></i>&thinsp;&thinsp;
                                Liste des services</a>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="mb-4">Ajouter un nouveau service</h2>
                                <form method="POST" action="{{ route('gestion_service.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="code" name="code" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="libelle" class="form-label">Libellé</label>
                                        <input type="text" class="form-control" id="libelle" name="libelle" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-dark"><i data-feather="save"></i>&thinsp;&thinsp;
                                        Enregistrer</button>
                                    <button type="reset" class="btn btn-danger"><i data-feather="x"></i>&thinsp;&thinsp;
                                        Annuler</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
