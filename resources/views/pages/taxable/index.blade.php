@extends('layouts.master')

@section('title')
    <title>SIG - CFE | Base taxable</title>
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
                                Liste des bases taxable
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
                <div class="card-header">Ajouter une nouvelle base taxable</div>
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
                            <div class="col-md-6">
                                <label class="small mb-1">Nom de la base</label>
                                <input class="form-control" name="libelle" type="text" value="{{ Request::old('libelle') }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Réference</label>
                                <input class="form-control" name="reference" type="text" value="{{ Request::old('reference') }}" required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Prix</label>
                                <input class="form-control" name="prix" type="number" value="{{ Request::old('prix') }}" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Famille</label>
                                <select name="familles_id" class="form-control">
                                    <option value="">Selectionner une famille</option>
                                    @foreach ($familles as $famille)
                                        <option value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-1" type="submit">
                            <i class="fas fa-save"></i>
                            &nbsp; &nbsp;Enregistrer
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
                                            <div class="sbp-preview-content">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Code</th>
                                                            <th class="text-center">Base taxable</th>
                                                            <th class="text-center">Réference</th>
                                                            <th class="text-center">Prix</th>
                                                            <th class="text-center">Famille</th>
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
                                                                <td
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <a class="" href="">
                                                                        <i class="me-2 text-green" data-feather="eye"></i>
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
