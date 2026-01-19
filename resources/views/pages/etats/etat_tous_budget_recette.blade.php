<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG - CFE | Etat des budgets recettes</title>
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

        <div class="d-flex justify-content-end m-3">
            <h5>Ouagadougou, le {{ date('d-m-Y') }}</h5>
        </div>

        <div class="text-center m-3 text-decoration-underline text-uppercase">
            <h3>Etat des budgets de recettes</h3>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="sbp-preview-content">
                        @foreach ($budgets as $budget)
                            @php
                                $somme_element = 0;
                                foreach ($budget->Recette as $facture) {
                                    $somme_element += $facture->ElementRecette->sum('montant');
                                }

                                $ecart = $budget->dotation - $somme_element;
                                $pourentage = ($somme_element * 100) / $budget->dotation;
                                $objet = 0;
                            @endphp
                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Libelle</th>
                                        <th>Dotation</th>
                                        <th>Total Realisation</th>
                                        <th>Ecart</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="background: #e0dddd">
                                        <td>BU{{ $budget->id }}</td>
                                        <td>{{ $budget->libelle }}</td>
                                        <td>{{ number_format($budget->dotation, 0, ',', ' ') }}</td>
                                        <td>{{ number_format($somme_element, 0, ',', ' ') }}</td>
                                        <td>{{ number_format($ecart, 0, ',', ' ') }}</td>
                                        <td>{{ intVal($pourentage) }} %</td>
                                    </tr>
                                    {{-- <tr>
                                        <th></th>
                                        <th>Activite</th>
                                        <th>Réalisation</th>
                                        <th>Date realisation</th>
                                    </tr> --}}
                                    @foreach ($budget->Recette as $item)
                                        @foreach ($item->ElementRecette as $element)
                                            <tr>
                                                <td>{{ $item->date }}</td>
                                                <td colspan="2">{{ $item->objet }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ number_format($element->montant, 0, ',', ' ') }}
                                                </td>
                                                {{-- <td>{{ $item->date }}</td> --}}
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
