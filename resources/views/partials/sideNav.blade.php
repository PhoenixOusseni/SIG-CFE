<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <div class="sidenav-menu-heading">Pages</div>
                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                        <div class="nav-link-icon"><i data-feather="grid"></i></div>
                        Tableau de bord
                    </a>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePagesAdmin" aria-expanded="false" aria-controls="collapsePagesAD">
                        <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        Administration
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePagesAdmin" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_utilisateur.index') }}">Gestion des utilisateur</a>
                            <a class="nav-link" href="{{ route('module_entete.index') }}">Entete</a>
                            <a class="nav-link" href="{{ route('module_signataire.index') }}">Signataire</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePagesPara" aria-expanded="false" aria-controls="collapsePagesPA">
                        <div class="nav-link-icon"><i data-feather="sliders"></i></div>
                        Paramètre
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePagesPara" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_famille.index') }}">Familles</a>
                            <a class="nav-link" href="{{ route('module_base_taxable.index') }}">Bases taxable</a>
                            <a class="nav-link" href="{{ route('module_categorie.index') }}">Catégories</a>
                            <a class="nav-link" href="{{ route('module_contribuable.index') }}">Contribuables</a>
                            <a class="nav-link" href="{{ route('module_fornisseur.index') }}">Fournisseurs</a>
                            <a class="nav-link" href="{{ route('module_source_prelevement.index') }}">Source de prelèvement</a>
                            <a class="nav-link" href="{{ route('module_budget.index') }}">Budget</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePagesST">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        Ordre de recette
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_ordre_recette.index') }}">Préparation</a>
                            <a class="nav-link" href="{{ route('valider') }}">Validation</a>
                            <a class="nav-link" href="{{ route('mise_reglement') }}">Mise en reglement</a>
                            <a class="nav-link" href="{{ route('reglement_recette') }}">Règlements</a>
                            <a class="nav-link" href="{{ route('all_recette') }}">Ordre de recette</a>
                            <a class="nav-link" href="{{ route('module_reglement.index') }}">Liste des règlements</a>
                            <a class="nav-link" href="">Journal des règlements</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#pagesCollapseErrorEB" aria-expanded="false" aria-controls="pagesCollapseError">
                        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                        Facture fournisseur
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseErrorEB" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_facture_fournisseur.index') }}">Préparation</a>
                            <a class="nav-link" href="{{ route('valider_facture') }}">Validation</a>
                            <a class="nav-link" href="{{ route('mise_reglement_facture') }}">Mise en reglement</a>
                            <a class="nav-link" href="{{ route('reglement_facture') }}">Règlements</a>
                            <a class="nav-link" href="{{ route('all_facture') }}">Facture fournisseur</a>
                            <a class="nav-link" href="{{ route('module_reglement_fournisseur.index') }}">Liste des règlements</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#pagesCollapseErrorST" aria-expanded="false" aria-controls="pagesCollapseError">
                        <div class="nav-link-icon"><i data-feather="pie-chart"></i></div>
                        Etat des budgets
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseErrorST" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#etatBudgetDepense">Budgets dépenses</a>
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#etatBudgetRecette">Budgets recettes</a>
                            <a class="nav-link" href="{{ route('depense_recette') }}">Recettes - Dépenses</a>
                        </nav>
                    </div>

                    <div class="sidenav-menu-heading">Suplementaires</div>

                    <a class="nav-link collapsed" href="{{ route('module_ordre_recette.index') }}">
                        <div class="nav-link-icon"><i data-feather="plus-circle"></i></div>
                        Créer ordre de recette
                    </a>

                    <a class="nav-link collapsed" href="{{ route('module_facture_fournisseur.index') }}">
                        <div class="nav-link-icon"><i data-feather="plus-square"></i></div>
                        Créer fact fourn
                    </a>

                    <a class="nav-link collapsed" href="{{ route('reglement_recette') }}">
                        <div class="nav-link-icon"><i data-feather="check-circle"></i></div>
                        Règlement recette
                    </a>

                    <a class="nav-link collapsed" href="{{ route('reglement_facture') }}">
                        <div class="nav-link-icon"><i data-feather="check-square"></i></div>
                        Règlement fact fourn
                    </a>

                    <a class="nav-link collapsed" href="{{ route('module_utilisateur.index') }}">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Gestion utilisateurs
                    </a>
                </div>
            </div>
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Utilisateur connecté(e):</div>
                    <div class="sidenav-footer-title">{{ Auth::user()->login }}</div>
                </div>
            </div>
        </nav>
    </div>
    @include('partials.etat_modal')
