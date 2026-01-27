<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    @yield('title')
    <title>SIG-CFE | Login</title>
    @yield('style')
    @include('partials.style')
    @notifyCss
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }

        body {
            background-image: url('{{ asset('images/abstract.png') }}');
            background-size: cover;
        }

        .iconna {
            width: 5%;
        }

        .img-icon {
            width: 20px;
        }

        .btn-1 {
            background-color: #2f663f;
            color: white;
        }
    </style>

<body class="nav-fixed">
    @include('notify::components.notify')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6 d-flex align-items-center justify-content-center">

                        <div class="col-lg-6 d-flex flex-column p-2" style="height: 60vh; background-color: #2f663f;">
                            <h4 class="text-center text-light m-3">Bienvenue dans SIG-CFE</h4>
                            <p class="text-justify text-light  m-3">
                                SIG-CFE un logiciel de gestion informatique de facturation permettant aux entreprises de
                                gérer et suivre leurs factures de manière efficace et automatisée
                            </p>
                            <div class="d-flex align-items-center mt-3">
                                <img src="{{ asset('images/double_tick_50px.png') }}" alt=""
                                    class="img-fluid iconna m-1">
                                <h4 class="m-1 text-light">GESTION DU BUDGET</h4>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <img src="{{ asset('images/double_tick_50px.png') }}" alt=""
                                    class="img-fluid iconna m-1">
                                <h4 class="m-1 text-light">GESTION ORDRE DE RECETTE</h4>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <img src="{{ asset('images/double_tick_50px.png') }}" alt=""
                                    class="img-fluid iconna m-1">
                                <h4 class="m-1 text-light">GESTION FACTURE FOURNISSEUR</h4>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <img src="{{ asset('images/double_tick_50px.png') }}" alt=""
                                    class="img-fluid iconna m-1">
                                <h4 class="m-1 text-light">ETATS DU BUDGET</h4>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center p-3 shadow"
                            style="height: 60vh; background-color: white;">
                            <h1 class="mb-5" style="font-size: 20px">AUTHENTIFICATION DU PORTAIL</h1>
                            <form method="POST" action="{{ route('auth') }}" class="row g-3 needs-validation">
                                @csrf
                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><img class="img-icon"
                                                src="{{ asset('images/user_shield_24px.png') }}" /></span>
                                        <input type="email" name="email" class="form-control" placeholder="Nom utilisateur" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><img class="img-icon"
                                                src="{{ asset('images/lock_26px.png') }}" /></span>
                                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mt-5">
                                    <button class="btn btn-1 w-100" type="submit">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('partials.script')
    @notifyJs
</body>

</html>
