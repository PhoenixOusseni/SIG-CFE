<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-FORVISMAZARS | Détail des marchés</title>
    @include('partials.style')
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .table-print { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table-print th, .table-print td { border: 1px solid #000; padding: 6px; text-align: left; font-size: 11px; }
        .table-print th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>

<body>
    <div id="layoutSidenav_content">
        @forelse (App\Models\Entete::all() as $item)
            <div style="border-bottom: 2px solid black; margin-bottom: 20px;">
                <div class="d-flex justify-content-between col-md-12">
                    <div class="col-2">
                        <img src="{{ asset('storage') . '/' . $item->logo }}" alt="Logo" style="width: 80px;">
                    </div>
                    <div class="col-6 text-center">
                        <h1 class="text-uppercase" style="font-size: 18px; margin: 5px 0;"><strong>{{ $item->denomination }}</strong></h1>
                        <h6 style="margin: 5px 0; font-size: 12px;">{{ $item->activite }}</h6>
                        <h6 style="margin: 5px 0; font-size: 12px;">{{ $item->postale }}</h6>
                    </div>
                    <div class="col-4 text-center">
                        <h3 style="font-size: 16px;">BURKINA FASO</h3>
                        <p>--------------------------</p>
                        <h5 style="font-size: 12px;">La Patrie ou la Mort, nous Vaincrons</h5>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-danger">Veuillez insérer une entête</p>
        @endforelse

        <div class="text-end" style="margin: 10px 0;">
            <h6 style="font-size: 12px;">Ouagadougou, le {{ date('d/m/Y') }}</h6>
        </div>

        <div class="text-center" style="margin: 20px 0;">
            <h3 style="font-size: 18px;"><strong>ÉTAT DÉTAILLÉ DES MARCHÉS</strong></h3>
            @if($request->filled('date_debut') || $request->filled('date_fin'))
                <p style="font-size: 12px;">Période du
                    {{ $request->filled('date_debut') ? \Carbon\Carbon::parse($request->date_debut)->format('d/m/Y') : '...' }}
                    au
                    {{ $request->filled('date_fin') ? \Carbon\Carbon::parse($request->date_fin)->format('d/m/Y') : '...' }}
                </p>
            @endif
        </div>

        @if($resultats->count() > 0)
            @php
                $grandTotalFacture = 0;
                $grandTotalRegle = 0;
                $grandReste = 0;
            @endphp

            @foreach($resultats as $result)
                <div style="margin-bottom: 30px; page-break-inside: avoid;">
                    <h4 style="background: #f5f5f5; padding: 8px; border-left: 4px solid #007bff; font-size: 14px;">
                        Marché : {{ $result->marche->code }} - {{ $result->marche->designation }}
                    </h4>

                    <p style="font-size: 11px; margin: 5px 0;">
                        <strong>Contribuable :</strong> {{ $result->marche->contribuable->assujeti ?? 'N/A' }}<br>
                        <strong>Montant :</strong> {{ number_format($result->marche->montant, 0, ',', ' ') }} FCFA<br>
                        <strong>Période :</strong> Du {{ $result->marche->date_debut ? \Carbon\Carbon::parse($result->marche->date_debut)->format('d/m/Y') : 'N/A' }}
                        au {{ $result->marche->date_cloture ? \Carbon\Carbon::parse($result->marche->date_cloture)->format('d/m/Y') : 'N/A' }}
                    </p>

                    @if($result->factures->count() > 0)
                        <table class="table-print">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Facture</th>
                                    <th>Fournisseur</th>
                                    <th>Date</th>
                                    <th>Montant HT</th>
                                    <th>TVA</th>
                                    <th>Montant TTC</th>
                                    <th>Réglé</th>
                                    <th>Reste</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result->factures as $index => $facture)
                                    @php
                                        $montantHT = $facture->ElementFacture->sum('montant_total');
                                        $montantTVA = ($montantHT * ($facture->tva ?? 0)) / 100;
                                        $montantTTC = $montantHT + $montantTVA;
                                        $regle = $facture->ReglementFournisseur->sum('versement');
                                        $reste = $montantTTC - $regle;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $facture->numero }}</td>
                                        <td>{{ $facture->Fournisseur->raison_sociale ?? 'N/A' }}</td>
                                        <td>{{ $facture->date ? \Carbon\Carbon::parse($facture->date)->format('d/m/Y') : 'N/A' }}</td>
                                        <td style="text-align: right;">{{ number_format($montantHT, 0, ',', ' ') }}</td>
                                        <td style="text-align: right;">{{ number_format($montantTVA, 0, ',', ' ') }}</td>
                                        <td style="text-align: right;">{{ number_format($montantTTC, 0, ',', ' ') }}</td>
                                        <td style="text-align: right;">{{ number_format($regle, 0, ',', ' ') }}</td>
                                        <td style="text-align: right;">{{ number_format($reste, 0, ',', ' ') }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background: #e9ecef; font-weight: bold;">
                                    <td colspan="6" style="text-align: right;">TOTAL MARCHÉ</td>
                                    <td style="text-align: right;">{{ number_format($result->total_facture, 0, ',', ' ') }}</td>
                                    <td style="text-align: right;">{{ number_format($result->total_regle, 0, ',', ' ') }}</td>
                                    <td style="text-align: right;">{{ number_format($result->reste, 0, ',', ' ') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p style="font-style: italic; color: #666; font-size: 11px;">Aucune facture pour ce marché</p>
                    @endif
                </div>

                @php
                    $grandTotalFacture += $result->total_facture;
                    $grandTotalRegle += $result->total_regle;
                    $grandReste += $result->reste;
                @endphp
            @endforeach

            <div style="margin-top: 20px;">
                <table class="table-print">
                    <tr style="background: #343a40; color: white; font-weight: bold;">
                        <td colspan="6" style="text-align: right; padding: 10px; font-size: 13px;">TOTAL GÉNÉRAL</td>
                        <td style="text-align: right; padding: 10px;">{{ number_format($grandTotalFacture, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 10px;">{{ number_format($grandTotalRegle, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 10px;">{{ number_format($grandReste, 0, ',', ' ') }} FCFA</td>
                    </tr>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px;">
                <p style="font-size: 14px; color: #6c757d;">Aucun résultat trouvé.</p>
            </div>
        @endif

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid black;">
            @forelse (App\Models\Entete::all() as $item)
                <p style="font-size: 10px;">{{ $item->pied_page }}</p>
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
