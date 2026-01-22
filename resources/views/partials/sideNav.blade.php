<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <div class="sidenav-menu-heading">Pages</div>
                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                        <div class="nav-link-icon"><i data-feather="home"></i></div>
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
                            <a class="nav-link" href="{{ route('module_utilisateur.index') }}">gestion des utilisateurs</a>
                            <a class="nav-link" href="{{ route('module_entete.index') }}">entête</a>
                            <a class="nav-link" href="{{ route('module_signataire.index') }}">signataire</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePagesPara" aria-expanded="false" aria-controls="collapsePagesPA">
                        <div class="nav-link-icon"><i data-feather="sliders"></i></div>
                        Paramètres
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePagesPara" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_famille.index') }}">département</a>
                            <a class="nav-link" href="{{ route('module_base_taxable.index') }}">prestation</a>
                            <a class="nav-link" href="{{ route('module_categorie.index') }}">catégories</a>
                            <a class="nav-link" href="{{ route('module_contribuable.index') }}">clients</a>
                            <a class="nav-link" href="{{ route('module_fornisseur.index') }}">fournisseurs</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePagesST">
                        <div class="nav-link-icon"><i data-feather="file"></i></div>
                        Factures
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_ordre_recette.index') }}">préparation</a>
                            <a class="nav-link" href="{{ route('valider') }}">validation</a>
                            <a class="nav-link" href="{{ route('mise_reglement') }}">mise en règlement</a>
                            <a class="nav-link" href="{{ route('reglement_recette') }}">règlements</a>
                            <a class="nav-link" href="{{ route('all_recette') }}">liste des factures</a>
                            <a class="nav-link" href="{{ route('module_reglement.index') }}">liste des règlements</a>
                            <a class="nav-link" href="">journal des règlements</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#pagesCollapseErrorEB" aria-expanded="false" aria-controls="pagesCollapseError">
                        <div class="nav-link-icon"><i data-feather="file-minus"></i></div>
                        Facture sous-traitant
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseErrorEB" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('module_facture_fournisseur.index') }}">préparation</a>
                            <a class="nav-link" href="{{ route('valider_facture') }}">validation</a>
                            <a class="nav-link" href="{{ route('mise_reglement_facture') }}">mise en règlement</a>
                            <a class="nav-link" href="{{ route('reglement_facture') }}">règlements</a>
                            <a class="nav-link" href="{{ route('all_facture') }}">liste des factures</a>
                            <a class="nav-link" href="{{ route('module_reglement_fournisseur.index') }}">liste des règlements</a>
                        </nav>
                    </div>

                    <div class="sidenav-menu-heading">FACTURATION</div>

                    <a class="nav-link collapsed" href="{{ route('module_ordre_recette.index') }}">
                        <div class="nav-link-icon"><i data-feather="file-plus"></i></div>
                        créer facture
                    </a>
                    <a class="nav-link collapsed" href="{{ route('module_facture_fournisseur.index') }}">
                        <div class="nav-link-icon"><i data-feather="file-plus"></i></div>
                        créer fact sous-traitant
                    </a>
                    <a class="nav-link collapsed" href="{{ route('reglement_recette') }}">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        règlement facture
                    </a>
                    <a class="nav-link collapsed" href="{{ route('reglement_facture') }}">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        règlement fact sous-traitant
                    </a>
                    <a class="nav-link collapsed" href="{{ route('module_utilisateur.index') }}">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        gestion utilisateurs
                    </a>

                    <div class="sidenav-menu-heading">GESTION DILIGENCES</div>

                    <a class="nav-link collapsed" href="{{ route('gestion_personnel.index') }}">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        Personnels
                    </a>
                    <a class="nav-link collapsed" href="{{ route('gestion_service.index') }}">
                        <div class="nav-link-icon"><i data-feather="layers"></i></div>
                        Services
                    </a>
                    <a class="nav-link collapsed" href="{{ route('gestion_diligence.index') }}">
                        <div class="nav-link-icon"><i data-feather="check-square"></i></div>
                        Diligences
                    </a>
                    <a class="nav-link collapsed" href="{{ route('gestion_critere.index') }}">
                        <div class="nav-link-icon"><i data-feather="list"></i></div>
                        Critères
                    </a>
                    <a class="nav-link collapsed" href="{{ route('gestion_traitement.index') }}">
                        <div class="nav-link-icon"><i data-feather="tool"></i></div>
                        Traitements
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
