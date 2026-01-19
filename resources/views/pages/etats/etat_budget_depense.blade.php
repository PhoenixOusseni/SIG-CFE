<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG - CFE | Etat budget dépense</title>
    @yield('style')
    @include('partials.style')
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }
        .tr_border {
            border: 1px solid black;
        }
        .th_border {
            border: 1px solid black;
            padding: 10px;
        }
        .td_border {
            border: 1px solid black;
            padding: 10px;
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
            <h3>Etat des budgets de dépenses</h3>
        </div>

        <div class="sbp-preview-content mt-3">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Libelle</th>
                        <th>Dotation</th>
                        <th>Total réalisation</th>
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
                        <th>Date</th>
                    </tr> --}}
                    @foreach ($factures as $item)
                        <tr>
                            <td>{{ $item->date }}</td>
                            <td colspan="2">{{ $item->objet }}</td>
                            <td>{{ number_format($item->ElementFacture->sum('montant_total'), 0, ',', ' ') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
