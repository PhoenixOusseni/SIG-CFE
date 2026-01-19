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

        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body">
                            <!-- Profile picture image-->
                            <div class="d-flex justify-content-center">
                                <img class="img-account-profile rounded-circle mb-2"
                                        src="{{ asset('images/auth-bg.jpg') }}" alt="logo user" />
                            </div>
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4 text-center">JPG ou PNG pas plus de 5 MB</div>
                            <!-- Profile picture upload button-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Detail du compte</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Nom</label>
                                        <input class="form-control" id="inputFirstName" type="text" value="{{ $finds->nom }}" />
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Prénom</label>
                                        <input class="form-control" id="inputLastName" type="text" value="{{ $finds->prenom }}" />
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="inputFirstName">Nom utilisateur</label>
                                        <input class="form-control" id="inputFirstName" type="text" value="{{ $finds->login }}" />
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="inputLastName">Role</label>
                                        <input class="form-control" id="inputLastName" type="text" value="{{ $finds->role }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="inputLastName">Email</label>
                                        <input class="form-control" id="inputLastName" type="email" value="{{ $finds->email }}" />
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <button class="btn btn-1" type="button" data-bs-toggle="modal" data-bs-target="#formPasswordBackdrop">
                                    <i class="fas fa-edit"></i>
                                    &nbsp; &nbsp;Changer mon mot de passe
                                </button>
                                <a href="{{ url('supp_user/' . $finds->id) }}" class="btn btn-danger" type="button">
                                    <i class="fas fa-trash"></i>
                                    &nbsp; &nbsp;Supprimer l'utilisateur
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal password -->
        <div class="modal fade" id="formPasswordBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">Changer mon mot de passe</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ url('change_password/' . $finds->id) }}">
                                @csrf
                                <div class="p-2 m-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label>Nouveau mot de passe<span class="text-danger">*</span></label>
                                                <input class="form-control" name="password" type="password" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-1">
                                        <i class="fas fa-edit"></i>
                                        &nbsp; &nbsp;Changer
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        <i class="fas fa-close"></i>
                                        &nbsp; &nbsp;Fermer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
