<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-CFE| Print Reglement facture fournisseur</title>
    @yield('style')
    @include('partials.style')
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }
    </style>

<body style="height: 90vh;">
    <div id="layoutSidenav_content">

        @forelse (App\Models\Entete::all() as $item)
            <div style="border-bottom: 1px solid black;">
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
        <p class="text-danger">Veuillez inserer une entete</p>
        @endforelse
        <div class="d-flex justify-content-end m-3">
            <h5>Ouagadougou, le {{ date('d-m-Y') }}</h5>
        </div>

        <div class="text-center mt-3 mb-5">
            <h4>REGLEMENT ORDRE DE RECETTE N° REG0{{ $reglements->id }}</h4>
        </div>

        <div class="d-flex justify-content-between m-3">
            <div class="col-6" style="border: 1px solid black; padding: 5px;">
                <h5>Contribuable : <strong>{{ $reglements->Recette->Contribuable->assujeti }}</strong></h5>
                <h5>Adresse : <strong>{{ $reglements->Recette->Contribuable->adresse }}</strong></h5>
                <h5>Téléphone : <strong>{{ $reglements->Recette->Contribuable->telephone }}</strong></h5>
                <h5>N° IFU : <strong>{{ $reglements->Recette->Contribuable->ifu }}</strong></h5>
                <h5>RCCM : <strong>{{ $reglements->Recette->Contribuable->rccm }}</strong></h5>
            </div>
            <div class="col-6 text-end">
                <h5>Date : <strong>{{ $reglements->Recette->date }}</strong></h5>
            </div>
        </div>

        <div class="col-12 text-start m-3">
            <h5>Numéro ordre de recette : <strong>{{ $reglements->Recette->id }}</strong></h5>
            <h5>Objet : <strong>{{ $reglements->Recette->objet }}</strong></h5>
        </div>

        <div class="m-3"></div>

        <div class="m-3">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr style="background: #cdc8c8">
                        <th>N°</th>
                        <th>Mode reglement</th>
                        <th>Net à payer</th>
                        <th>Versement</th>
                        <th>Reste à payer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="height: 20vh">
                        <td>{{ $reglements->id }}</td>
                        <td>{{ $reglements->mode_reglement }}</td>
                        <td>{{ number_format($reglements->net, 0, ',', ' ') }}</td>
                        <td>{{ number_format($reglements->versement, 0, ',', ' ') }}</td>
                        <td>{{ number_format($reglements->reste, 0, ',', ' ') }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered border-dark">
                <thead>
                    <tr class="text-center">
                        <th colspan="4">MONTANT TOTAL</th>
                        <th colspan="2" style="background: #cdc8c8">{{ number_format($reglements->versement, 0, ',', ' ') }} FCFA</th>
                    </tr>
                </thead>
            </table>
            <p>Arreté le présent ordre de recette à la somme de
                <strong>({{ number_format($reglements->versement, 0, ',', ' ') }}) FRANCS CFA</strong>
            </p>
        </div>

        {{-- Pied de page --}}
        <div class="p-3" style="margin-top: 70px; border-top: 1px solid black;">
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
