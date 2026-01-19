@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Regelement ordre de recette</title>
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
                                Réglement de l'ordre de recette N° {{ $reglement->id }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->

        <div class="container-xl px-4 mt-n10" style="margin-bottom: 8rem;">
            <!-- Account details card-->
            <form action="" method="POST">
                @csrf
                @method('PATCH')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card card-default">
                            <div class="card-body">
                                <fieldset class="w-100 p-2" style="border-radius: 5px; background: rgb(234, 233, 233)">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Date de reglement</label>
                                                <input class="form-control" name="date" type="date" value="{{ $reglement->date }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Net à payer</label>
                                                <input class="form-control" name="net" type="number" value="{{ $reglement->net }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Reste à payer</label>
                                                <input class="form-control" name="reste" type="number" value="{{ $reglement->reste }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Versement</label>
                                                <input class="form-control" name="versement" type="number" value="{{ $reglement->versement }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="small mb-1">Mode de reglement</label>
                                                <select name="mode_reglement" class="form-control">
                                                    <option value="{{ $reglement->mode_reglement }}">{{ $reglement->mode_reglement }}</option>
                                                    <option value="Espèce">Espèce</option>
                                                    <option value="Chèque">Chèque</option>
                                                    <option value="Virement">Virement</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                        &nbsp; &nbsp; Modifier
                                    </a>
                                    <a href="{{ url('print_reglement_recette/' . $reglement->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-print"></i>
                                        &nbsp; &nbsp;Imprimer
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        &nbsp; &nbsp;Supprimer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
