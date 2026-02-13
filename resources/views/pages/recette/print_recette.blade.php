<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-CFE| Print facture</title>
    @yield('style')
    @include('partials.style')
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }
    </style>

<body style="height: 90vh;">
    <div id="layoutSidenav_content">

        <div class="text-center mt-3 mb-5">
            <h2><strong>NOTE D'HONORAIRES INTERNE N°{{ $recette->code }}</strong></h2>
            <P>du {{ $recette->created_at->format('d/m/Y') }}</P>
        </div>

        <div class="d-flex justify-content-between m-3">
            <div class="col-6" style="border: 1px solid black; padding: 5px;">
                <h5>Client : <strong>{{ $recette->Contribuable->assujeti }}</strong></h5>
                <h5>Adresse : <strong>{{ $recette->Contribuable->adresse }}</strong></h5>
                <h5>Téléphone : <strong>{{ $recette->Contribuable->telephone }}</strong></h5>
                <h5>N° IFU : <strong>{{ $recette->Contribuable->ifu }}</strong></h5>
                <h5>RCCM : <strong>{{ $recette->Contribuable->rccm }}</strong></h5>
                <h5>Division fiscal : <strong>{{ $recette->Contribuable->division_fiscal }}</strong></h5>
                <h5>Regime fiscal : <strong>{{ $recette->Contribuable->regime_fiscal }}</strong></h5>
                <h5>Adresse cadastrale : <strong>{{ $recette->Contribuable->adresse_cadas }}</strong></h5>
            </div>
            <div class="col-6 text-start" style="margin-left: 50px;">
                <h5>Date : <strong>{{ $recette->created_at->format('d/m/Y') }}</strong></h5>
                <h5>Département : <strong>{{ $recette->Service->libelle ?? 'N/A' }}</strong></h5>
            </div>
        </div>

        <div class="text-start mt-5">
            <h5 class="m-3">Référence : <strong>{{ $recette->reference }}</strong></h5>
        </div>

        <div class="m-3">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr style="background-color: rgb(193, 198, 203)">
                        <th>Compte</th>
                        <th>Nature de la dépense</th>
                        <th class="text-center">Qte</th>
                        <th class="text-center">P.Unitaire</th>
                        <th class="text-center">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $elmnt)
                        <tr>
                            <td>{{ $elmnt->Base->code }}</td>
                            <td>{{ $elmnt->designation }}</td>
                            <td class="text-center">{{ $elmnt->quantite }}</td>
                            <td class="text-center">{{ $elmnt->prix_unitaire }}</td>
                            <td class="text-center">{{ $elmnt->montant }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-5 text-end">
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>Sous-total</th>
                            <td>{{ number_format($montant_total, 0, ',', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>TVA (18%)</th>
                            <td>{{ number_format($tva, 0, ',', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>Total TTC</th>
                            <td><strong>{{ number_format($montant_total_ttc, 0, ',', ' ') }} FCFA</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                <p>Arrêté la présente note d'honoraire à la somme de :
                    <strong style="text-transform: uppercase;">{{ conversion($montant_total_ttc) }} FRANCS CFA</strong>
                </p>
                <p>
                    ({{ number_format($montant_total_ttc, 0, ',', ' ') }} FCFA)
                </p>
            </div>

            <div class="mt-4">
                <h5>Conditions : Délais de livraison : disponibilité</h5>
            </div>

            <div class="mt-4">
                Division fiscale : DME-CV <br>
                Régime Normal d’imposition <br>
                N° IFU : 00019969J <br>
                Forme juridique : SA <br>
                Notre Adresse Cadastrale : Parcelle 03, Lot 13, Section 006(AI), Secteur 04 (ZACA)
            </div>

            <div class="d-flex justify-content-end mt-5">
                <div></div>
                <div class="text-center shadowbg-body rounded">
                    <h4>FORVIS MAZARS</h4>
                    <h6>{{ $recette->user->nom }} {{ $recette->user->prenom }}</h6>
                    <p>{{ $recette->user->role }}</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
