@extends('layouts.master')

@section('content')
    @include('require.header')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <!-- Example Charts for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-12">
                <!-- Tabbed dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="text-center">ETATS D'EXECUTIONS</h4>
                        <div class="col-sm-12 mb-3">
                            <a href="#" class="btn btn-light"><i data-feather="activity"></i>&thinsp;&thinsp;
                                Exécution par poste</a>
                            <a href="#" class="btn btn-light"><i data-feather="activity"></i>&thinsp;&thinsp;
                               Exécution par service</a>
                               <a href="#" class="btn btn-light"><i data-feather="activity"></i>&thinsp;&thinsp;
                               Exécution par employer</a>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Membre</th>
                                    <th>Période</th>
                                    <th>Mode paiement</th>
                                    <th>Montant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <a class="text-center" href=""><i class="me-2 text-green"
                                                data-feather="eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
