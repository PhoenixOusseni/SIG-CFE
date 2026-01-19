<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-CFE | Print facture fournisseur</title>
    @yield('style')
    @include('partials.style')
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }
    </style>

<body style="height: 90vh; padding: 10px;">
    <div id="layoutSidenav_content">
        @forelse ($entetes as $item)
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
            <p class="text-danger">Veuillez inserer une entete de la société !</p>
        @endforelse

        <div class="d-flex justify-content-end">
            <h5>Ouagadougou, le {{ date('d-m-Y') }}</h5>
        </div>

        <div class="text-center mt-3 mb-5">
            <h4 class="text-decoration-underline"><strong>FACTURE N° FAC0{{ $factures->id }}</strong></h4>
        </div>

        <div class="d-flex justify-content-between">
            <div class="col-6" style="border: 1px solid black; padding: 5px;">
                <h5>Fournisseur : <strong>{{ $factures->Fournisseur->libelle }}</strong></h5>
                <h5>Adresse : <strong>{{ $factures->Fournisseur->adresse }}</strong></h5>
                <h5>Téléphone : <strong>{{ $factures->Fournisseur->telephone }}</strong></h5>
                <h5>N° IFU : <strong>{{ $factures->Fournisseur->ifu }}</strong></h5>
                <h5>RCCM : <strong>{{ $factures->Fournisseur->rccm }}</strong></h5>
            </div>
            <div class="col-6 text-end">
                <h5>Date : <strong>{{ $factures->date }}</strong></h5>
            </div>
        </div>

        <div class="mt-5">
            <h5><span class="text-decoration-underline">Objet :</span> <strong>{{ $factures->objet }}</strong></h5>
        </div>

        <table class="table table-bordered border-dark">
            <thead>
                <tr style="background-color: rgb(193, 198, 203)">
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>P.Unitaire</th>
                    <th>P.Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ht = 0;
                @endphp
                @foreach ($factures->ElementFacture as $elem)
                    <tr>
                        <td>{{ $elem->designation }}</td>
                        <td>{{ $elem->quantite }}</td>
                        <td>{{ number_format($elem->prix_unitaire, 0, ',', ' ') }}</td>
                        <td>{{ number_format($elem->montant_total, 0, ',', ' ') }}</td>
                        @php
                            $ht += $elem->montant_total;
                            $tva = ($elem->montant_total * $factures->tva) / 100;

                            $ttc = $ht + $tva;
                            $retnu = $factures->total_retenu;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            <h4>TVA : {{ $factures->tva }} % : <strong>{{ number_format($tva, 0, ',', ' ') }} FCFA</strong></h4>
            <h4>&nbsp; &nbsp; | &nbsp; &nbsp;Montant retenu : <strong>{{ number_format($retnu, 0, ',', ' ') }} FCFA</strong></h4>
        </div>

        <table class="table table-bordered border-dark">
            <thead>
                <tr class="text-center">
                    <th>MONTANT HT</th>
                    <th>MONTANT TTC</th>
                </tr>
                <tr class="text-center">
                    <th style="background-color: rgb(193, 198, 203)">{{ $ht - $retnu }} FCFA</th>
                    <th style="background-color: rgb(193, 198, 203)">{{ $ttc - $retnu }} FCFA</th>
                </tr>
            </thead>
        </table>
        <p>Arreté le présent ordre de recette à la somme de
            <strong>({{ number_format($ht, 0, ',', ' ') }}) FRANCS CFA</strong>
        </p>

        <div class="text-end m-3" style="margin-top: 50px;">
            <img src="{{ asset('storage') . '/' . $factures->Signataire->photo }}" class="w-25" alt="logo entete">
            <h4>{{ $factures->Signataire->nom }}</h4>
            <p>{{ $factures->Signataire->fonction }}</p>
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
