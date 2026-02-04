<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-FORVISMAZARS | Solde Fournisseur</title>
    @include('partials.style')
    <style>
        body { font-family: Arial, sans-serif; }
        .table-print { width: 100%; border-collapse: collapse; }
        .table-print th, .table-print td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table-print th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>

<body>
    <div id="layoutSidenav_content">
        @forelse (App\Models\Entete::all() as $item)
            <div style="border-bottom: 2px solid black; margin-bottom: 20px;">
                <div class="d-flex justify-content-between col-md-12">
                    <div class="col-2">
                        <img src="{{ asset('storage') . '/' . $item->logo }}" alt="Logo" style="width: 100px;">
                    </div>
                    <div class="col-6 text-center">
                        <h1 class="text-uppercase" style="font-size: 20px; margin: 5px 0;"><strong>{{ $item->denomination }}</strong></h1>
                        <h6 style="margin: 5px 0;">{{ $item->activite }}</h6>
                        <h6 style="margin: 5px 0;">{{ $item->postale }}</h6>
                    </div>
                    <div class="col-4 text-center">
                        <h3>BURKINA FASO</h3>
                        <p>--------------------------</p>
                        <h5>La Patrie ou la Mort, nous Vaincrons</h5>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-danger">Veuillez insérer une entête</p>
        @endforelse

        <div class="text-end" style="margin: 20px 0;">
            <h6>Ouagadougou, le {{ date('d/m/Y') }}</h6>
        </div>

        <div class="text-center" style="margin: 30px 0;">
            <h3><strong>ÉTAT DES SOLDES FOURNISSEURS</strong></h3>
            @if($request->filled('date_debut') || $request->filled('date_fin'))
                <p>Période du
                    {{ $request->filled('date_debut') ? \Carbon\Carbon::parse($request->date_debut)->format('d/m/Y') : '...' }}
                    au
                    {{ $request->filled('date_fin') ? \Carbon\Carbon::parse($request->date_fin)->format('d/m/Y') : '...' }}
                </p>
            @endif
        </div>

        @if($soldes->count() > 0)
            <table class="table-print">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Fournisseur</th>
                        <th>Téléphone</th>
                        <th>Total Facturé</th>
                        <th>Total Réglé</th>
                        <th>Solde</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalFacture = 0;
                        $totalRegle = 0;
                        $totalSolde = 0;
                    @endphp
                    @foreach($soldes as $index => $solde)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $solde->fournisseur->raison_sociale }}</td>
                            <td>{{ $solde->fournisseur->telephone }}</td>
                            <td style="text-align: right;">{{ number_format($solde->total_facture, 0, ',', ' ') }}</td>
                            <td style="text-align: right;">{{ number_format($solde->total_regle, 0, ',', ' ') }}</td>
                            <td style="text-align: right;">{{ number_format($solde->solde, 0, ',', ' ') }}</td>
                        </tr>
                        @php
                            $totalFacture += $solde->total_facture;
                            $totalRegle += $solde->total_regle;
                            $totalSolde += $solde->solde;
                        @endphp
                    @endforeach
                    <tr style="background: #343a40; color: white; font-weight: bold;">
                        <td colspan="3" style="text-align: right; padding: 12px;">TOTAL GÉNÉRAL</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($totalFacture, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($totalRegle, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($totalSolde, 0, ',', ' ') }} FCFA</td>
                    </tr>
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 40px;">
                <p style="font-size: 16px; color: #6c757d;">Aucun résultat trouvé.</p>
            </div>
        @endif

        <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid black;">
            @forelse (App\Models\Entete::all() as $item)
                <p style="font-size: 12px;">{{ $item->pied_page }}</p>
            @empty
                <p class="text-danger">Veuillez insérer un pied de page</p>
            @endforelse
        </div>
    </div>

    <script>
        window.onload = function() { window.print(); };
    </script>
</body>
</html>
