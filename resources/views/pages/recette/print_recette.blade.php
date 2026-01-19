<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-CFE| Print ordre de recette</title>
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
            <h4>ORDRE DE RECETTE N° FAC0{{ $recette->id }}</h4>
        </div>

        <div class="d-flex justify-content-between m-3">
            <div class="col-6" style="border: 1px solid black; padding: 5px;">
                <h5>Contribuable : <strong>{{ $recette->Contribuable->assujeti }}</strong></h5>
                <h5>Adresse : <strong>{{ $recette->Contribuable->adresse }}</strong></h5>
                <h5>Téléphone : <strong>{{ $recette->Contribuable->telephone }}</strong></h5>
                <h5>N° IFU : <strong>{{ $recette->Contribuable->ifu }}</strong></h5>
                <h5>RCCM : <strong>{{ $recette->Contribuable->rccm }}</strong></h5>
            </div>
            <div class="col-6 text-end">
                <h5>Date : <strong>{{ $recette->date }}</strong></h5>
                <h5>Du : <strong>{{ $recette->periode_debut }}</strong> Au
                    <strong>{{ $recette->periode_fin }}</strong></h5>
                <h5>Date écheance : <strong>{{ $recette->echeance }}</strong></h5>
            </div>
        </div>
        <div class="text-start mt-5">
            <h5 class="m-3">Objet : <strong>{{ $recette->objet }}</strong></h5>
        </div>

        <div class="m-3">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr style="background-color: rgb(193, 198, 203)">
                        <th>Designation</th>
                        <th>Source prelevement</th>
                        <th>Unité</th>
                        <th>Qte</th>
                        <th>P.Unitaire</th>
                        <th>P.Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $elmnt)
                        <tr>
                            <td>{{ $elmnt->Base->libelle }}</td>
                            <td>{{ $elmnt->Source->libelle }}</td>
                            <td>{{ $elmnt->unite }}</td>
                            <td>{{ $elmnt->quantite }}</td>
                            <td>{{ $elmnt->prix_unitaire }}</td>
                            <td>{{ $elmnt->montant }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="table table-bordered border-dark">
                <thead>
                    <tr class="text-center">
                        <th colspan="4">MONTANT TOTAL</th>
                        <th style="background-color: rgb(193, 198, 203)" colspan="2">
                            {{ number_format($montant_total, 0, ',', ' ') }} FCFA</th>
                    </tr>
                </thead>
            </table>
            <p>Arreté le présent ordre de recette à la somme de
                <strong>({{ number_format($montant_total, 0, ',', ' ') }}) FRANCS CFA</strong>
            </p>
        </div>

        <div class="text-end m-3" style="margin-top: 50px;">
            <img src="{{ asset('storage') . '/' . $recette->Signataire->photo }}" class="w-25" alt="logo entete">
            <h4>{{ $recette->Signataire->nom }}</h4>
            <p>{{ $recette->Signataire->fonction }}</p>
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
