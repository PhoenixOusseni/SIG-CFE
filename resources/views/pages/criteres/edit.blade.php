@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Modifier un critère</title>
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
                            <div class="page-header-icon"><i data-feather="edit"></i></div>
                            Modifier un critère
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
                            <a href="{{ route('gestion_critere.create') }}" class="btn btn-light"><i data-feather="plus"></i>&thinsp;&thinsp;
                                Ajouter une critère</a>
                            <a href="{{ route('gestion_critere.index') }}" class="btn btn-light"><i data-feather="align-left"></i>&thinsp;&thinsp;
                               Liste des critères</a>
                        </div>
                        <form action="{{ route('gestion_critere.update', $finds->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label class="small">Code</label>
                                    <input type="text" name="code" class="form-control" value="{{ $finds->code }}" required>
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-5">
                                    <label class="small">Diligence</label>
                                    <select name="diligence_id" name="diligence_id" class="form-select" required>
                                        <option selected disabled>Sélectionner une diligence...</option>
                                        @foreach ($diligences as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $finds->diligence_id ? 'selected' : '' }}>
                                                {{ $item->code }} {{ $item->designation }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="small">Service</label>
                                    <select name="service_id" class="form-select" required>
                                        <option selected disabled>Sélectionner un service...</option>
                                        @foreach ($services as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $finds->service_id ? 'selected' : '' }}>
                                                {{ $item->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small">Désignation</label>
                                    <input type="text" name="designation" class="form-control" value="{{ $finds->designation }}">
                                    <div class="invalid-feedback">Ce champ est requis</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small">Taux</label>
                                    <input type="number" name="taux" class="form-control" value="{{ $finds->taux }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="small">PJ 1</label>
                                    <input type="file" name="pj1" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="small">PJ 2</label>
                                    <input type="file" name="pj2" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="small">PJ 3</label>
                                    <input type="file" name="pj3" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="small">Appreciation</label>
                                    <textarea name="appreciation" class="form-control" cols="30" rows="5">{{ $finds->appreciation }}</textarea>
                                </div>
                            </div>

                            <div class="m-0">
                                <button type="submit" class="btn btn-dark"><i data-feather="save"></i>&thinsp;&thinsp; Modifier</button>
                                <button type="reset" class="btn btn-danger"><i data-feather="x"></i>&thinsp;&thinsp; Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
