<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    <title>SIG-CFE | État des recettes par catégorie</title>
    @include('partials.style')
    <style>
        .inset-0 {
            z-index: 999999999 !important;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .table-print {
            width: 100%;
            border-collapse: collapse;
        }
        .table-print th, .table-print td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table-print th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="layoutSidenav_content">

        @forelse (App\Models\Entete::all() as $item)
            <div style="border-bottom: 2px solid black; margin-bottom: 20px;">
                <div class="d-flex justify-content-between col-md-12">
                    <div class="col-2">
                        <img src="{{ asset('storage') . '/' . $item->logo }}" alt="Logo" class="img-fluid"
                            style="width: 100px;">
                    </div>
                    <div class="col-6 text-center">
                        <h1 class="text-uppercase" style="font-size: 20px; margin: 5px 0;">
                            <strong>{{ $item->denomination }}</strong>
                        </h1>
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
            <h3><strong>ÉTAT DES RECETTES PAR CATÉGORIE</strong></h3>
            @if($request->filled('date_debut') || $request->filled('date_fin'))
                <p>Période du
                    {{ $request->filled('date_debut') ? \Carbon\Carbon::parse($request->date_debut)->format('d/m/Y') : '...' }}
                    au
                    {{ $request->filled('date_fin') ? \Carbon\Carbon::parse($request->date_fin)->format('d/m/Y') : '...' }}
                </p>
            @endif
        </div>

        @if($resultats->count() > 0)
            @php
                $grandTotalMontant = 0;
                $grandTotalRegle = 0;
                $grandReste = 0;
            @endphp

            @foreach($resultats as $result)
                <div style="margin-bottom: 40px;">
                    <h4 style="background: #f5f5f5; padding: 10px; border-left: 4px solid #007bff;">
                        Catégorie : {{ $result->categorie->libelle }}
                    </h4>

                    <table class="table-print">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Code</th>
                                <th>Référence</th>
                                <th>Contribuable</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Réglé</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result->recettes as $index => $recette)
                                @php
                                    $montant = $recette->ElementRecette->sum('montant');
                                    $regle = $recette->Reglement->sum('versement');
                                    $reste = $montant - $regle;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $recette->code }}</td>
                                    <td>{{ $recette->reference }}</td>
                                    <td>{{ $recette->Contribuable->assujeti ?? 'N/A' }}</td>
                                    <td>{{ $recette->date ? \Carbon\Carbon::parse($recette->date)->format('d/m/Y') : 'N/A' }}</td>
                                    <td style="text-align: right;">{{ number_format($montant, 0, ',', ' ') }}</td>
                                    <td style="text-align: right;">{{ number_format($regle, 0, ',', ' ') }}</td>
                                    <td style="text-align: right;">{{ number_format($reste, 0, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                            <tr style="background: #e9ecef; font-weight: bold;">
                                <td colspan="5" style="text-align: right;">TOTAL {{ strtoupper($result->categorie->libelle) }}</td>
                                <td style="text-align: right;">{{ number_format($result->total_montant, 0, ',', ' ') }}</td>
                                <td style="text-align: right;">{{ number_format($result->total_regle, 0, ',', ' ') }}</td>
                                <td style="text-align: right;">{{ number_format($result->reste, 0, ',', ' ') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @php
                    $grandTotalMontant += $result->total_montant;
                    $grandTotalRegle += $result->total_regle;
                    $grandReste += $result->reste;
                @endphp
            @endforeach

            <div style="margin-top: 30px;">
                <table class="table-print">
                    <tr style="background: #343a40; color: white; font-weight: bold; font-size: 14px;">
                        <td colspan="5" style="text-align: right; padding: 12px;">TOTAL GÉNÉRAL</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($grandTotalMontant, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($grandTotalRegle, 0, ',', ' ') }} FCFA</td>
                        <td style="text-align: right; padding: 12px;">{{ number_format($grandReste, 0, ',', ' ') }} FCFA</td>
                    </tr>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px;">
                <p style="font-size: 16px; color: #6c757d;">Aucun résultat trouvé pour les critères sélectionnés.</p>
            </div>
        @endif

        {{-- Pied de page --}}
        <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid black;">
            @forelse (App\Models\Entete::all() as $item)
                <p style="font-size: 12px;">{{ $item->pied_page }}</p>
            @empty
                <p class="text-danger">Veuillez insérer un pied de page</p>
            @endforelse
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
