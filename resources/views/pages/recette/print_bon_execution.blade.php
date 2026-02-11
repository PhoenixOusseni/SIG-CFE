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

        <div class="p-3">
            <div class="text-center mb-4">
                <h2>ATTESTATION DE BONNE EXECUTION</h2>
            </div>
            <p>
                Je soussigné <span
                    style="border-bottom: 1px dotted #000; min-width: 200px; display: inline-block;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>,
                Gérant de la Société<span
                    style="border-bottom: 1px dotted #000; min-width: 200px; display: inline-block;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>,
                atteste par la presente que le Cabinet SAFRECO a réalisé une
                <span
                    style="border-bottom: 1px dotted #000; min-width: 400px; display: inline-block;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </p>

            <p style="text-align: justify; line-height: 2.5;">
                L'intervention du cabinet
                <span
                    style="border-bottom: 1px dotted #000; min-width: 400px; display: inline-block;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                et a couvert les volet suivants
            </p>

            <div class="mt-4 text-center">
                <p style="line-height: 1.8;">
                    @foreach ($elements as $element)
                        - {{ $element->Base->libelle ?? 'N/A' }} <br>
                    @endforeach
                </p>
            </div>

            <p style="text-align: justify; line-height: 2.5;">
                Les traveaux s'est déroulé avec serieux et professionalisme dans le respects des termes
                du contrat avec notre satisfaction
            </p>

            <p style="text-align: justify; line-height: 2.5; margin-top: 30px;">
                En foi de quoi, nous lui délivrons la presente attestation pour service et valoir ce que de droit
            </p>
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
