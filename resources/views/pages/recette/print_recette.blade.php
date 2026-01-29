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
        @forelse ($entetes as $item)
            <div style="border-bottom: 1px solid black; margin: 10px;">
                <div class="d-flex justify-content-between col-md-12">
                    <div class="col-2">
                        <img src="{{ asset('storage') . '/' . $item->logo }}" alt="Logo" class="img-fluid"
                            style="width: 100px;">
                    </div>
                    <div class="col-6">
                        <h1 class="text-center text-uppercase mt-1" style="font-size: 20px;">
                            <strong>{{ $item->denomination }}</strong>
                        </h1>
                        <h6 class="mt-1 text-center">{{ $item->activite }}</h6>
                        <h5 class="mt-1 text-center">{{ $item->postale }}</h5>
                    </div>
                    <div class="col-4 text-center">
                        <h3>BURKINA FASO</h3>
                        <P>--------------------------</P>
                        <h5>La Patrie ou la Mort, nous Vaincrons</h5>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-danger">Veuillez inserer une entete de la société !</p>
        @endforelse

        <div class="d-flex justify-content-end m-3">
            <h5>Ouagadougou, le {{ date('d-m-Y') }}</h5>
        </div>

        <div class="text-center mt-3 mb-5">
            <h2><strong>FACTURE N°{{ $recette->code }}</strong></h2>
        </div>

        <div class="d-flex justify-content-between m-3">
            <div class="col-6" style="border: 1px solid black; padding: 5px;">
                <h5>Client : <strong>{{ $recette->Contribuable->assujeti }}</strong></h5>
                <h5>Adresse : <strong>{{ $recette->Contribuable->adresse }}</strong></h5>
                <h5>Téléphone : <strong>{{ $recette->Contribuable->telephone }}</strong></h5>
                <h5>N° IFU : <strong>{{ $recette->Contribuable->ifu }}</strong></h5>
                <h5>RCCM : <strong>{{ $recette->Contribuable->rccm }}</strong></h5>
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
                        <th>Designation</th>
                        <th class="text-center">Qte</th>
                        <th class="text-center">P.Unitaire</th>
                        <th class="text-center">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $elmnt)
                        <tr>
                            <td>{{ $elmnt->Base->libelle }}</td>
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
                <p>Arrêté le présent facture à la somme de :
                    <strong style="text-transform: uppercase;">{{ conversion($montant_total) }} FRANCS CFA</strong>
                </p>
                <p>
                    ({{ number_format($montant_total, 0, ',', ' ') }} FCFA)
                </p>
            </div>

            <div class="mt-5">
                <h5>Conditions :</h5>
                <div class="d-flex justify-content-between">
                    <p>Délais de livraison : disponibilité</p>
                    <p>Délais de paiement : 100% à la livraison</p>
                </div>
            </div>
        </div>

        {{-- Pied de page --}}
        <div class="p-3" style="margin-top: 20px; border-top: 1px solid black;">
            @forelse (App\Models\Entete::all() as $item)
                <p>{{ $item->pied_page }}</p>
            @empty
                <p class="text-danger">Veuillez inserer un pied de page</p>
            @endforelse
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
