@extends('voyager::master')
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 90%;
        margin: auto;
    }

    h2 {
        color: black;

    }

    #customers td,
    #customers th {
        /* border: 1px solid rgb(251, 177, 112); */
        border: 1px solid #ddd;
        padding: 8px;
        color: black;
        background-color: #ffffff;
    }

    td {
        text-align: center;
    }

    #customers tr:nth-child(even) {
        background-color: #ffffff;
    }

    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        color: rgb(0, 0, 0);

    }
</style>
@php

@endphp
@section('content')
    <h2 style="margin-bottom: 40px;color: black;text-align:center;font-family:fangsong">fiche realisation physique du
        perimetre </h2>

    <table style="margin-top: 50px" id="customers">
        <thead>
            <tr>
                <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">Réalisations
                    sismiques 2D (Km)</th>
            </tr>
            <tr>
                <th>Désignations</th>
                <th>Nom de l’étude </th>
                <th>Année de réalisation</th>
                <th>Compagnie de service</th>
                <th>Kilometrage Km²</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th rowspan="100">Traitement</th>
            </tr>
            @foreach ($realisation2D as $rela2D)
                <tr>
                    <td>{{ $rela2D->NomCub }}</td>
                    <td>{{ $rela2D->AnneeRealisation }}</td>
                    <td>{{ $rela2D->CompagnieServise }}</td>
                    <td>{{ $rela2D->Kilometrage }}</td>
                </tr>
            @endforeach

        </tbody>

        <tbody>
            <tr>
                <th rowspan="100">Retraitement</th>
            </tr>
            @foreach ($ReTraitement2D as $rela2D)
                <tr>
                    <td>{{ $rela2D->NomCub }}</td>
                    <td>{{ $rela2D->AnneeRealisation }}</td>
                    <td>{{ $rela2D->CompagnieServise }}</td>
                    <td>{{ $rela2D->Kilometrage }}</td>
                </tr>
            @endforeach
        </tbody>
        <tbody>
            <tr>
                <th rowspan="100">Acquisition</th>
            </tr>
            @foreach ($Acquisition2D as $rela2D)
                <tr>
                    <td>{{ $rela2D->NomCub }}</td>
                    <td>{{ $rela2D->AnneeRealisation }}</td>
                    <td>{{ $rela2D->CompagnieServise }}</td>
                    <td>{{ $rela2D->Kilometrage }}</td>
                </tr>
            @endforeach
        </tbody>
        {{-- <tr>
          <th colspan="4" style="text-align: center">total</th>
          <td>{{ $total2D }}</td>
        </tr> --}}
    </table>

    <table style="margin-top: 50px" id="customers">
        <thead>
            <tr>
                <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">Réalisations
                    sismiques 3D (Km²)</th>
            </tr>
            <tr>
                <th>Désignations</th>
                <th>Nom de l’étude </th>
                <th>Année de réalisation</th>
                <th>Compagnie de service</th>
                <th>Kilometrage Km²</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th rowspan="100">Traitement</th>
            </tr>
            @foreach ($realisation3D as $rela3D)
                <tr>
                    <td>{{ $rela3D->NomCub }}</td>
                    <td>{{ $rela3D->AnneeRealisation }}</td>
                    <td>{{ $rela3D->CompagnieServise }}</td>
                    <td>{{ $rela3D->Kilometrage }}</td>
                </tr>
            @endforeach

        </tbody>

        <tbody>
            <tr>
                <th rowspan="100">Retraitement</th>
            </tr>
            @foreach ($ReTraitement3D as $rela3D)
                <tr>
                    <td>{{ $rela3D->NomCub }}</td>
                    <td>{{ $rela3D->AnneeRealisation }}</td>
                    <td>{{ $rela3D->CompagnieServise }}</td>
                    <td>{{ $rela3D->Kilometrage }}</td>
                </tr>
            @endforeach
        </tbody>
        <tbody>
            <tr>
                <th rowspan="100">Acquisition</th>
            </tr>
            @foreach ($Acquisition3D as $rela3D)
                <tr>
                    <td>{{ $rela3D->NomCub }}</td>
                    <td>{{ $rela3D->AnneeRealisation }}</td>
                    <td>{{ $rela3D->CompagnieServise }}</td>
                    <td>{{ $rela3D->Kilometrage }}</td>
                </tr>
            @endforeach
        </tbody>

        {{-- <tr>
          <th colspan="4" style="text-align: center">total</th>
          <td>{{ $total3D }}</td>
        </tr> --}}

    </table>





    <table style="margin-top: 50px" id="customers">
        <thead>
            <tr>
                <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">Réalisations
                    sismiques methode potentiel (Km²)</th>
            </tr>
            <tr>
                <th>Désignations</th>
                <th>Nom de l’étude </th>
                <th>Année de réalisation</th>
                <th>Compagnie de service</th>
                <th>Kilometrage Km²</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th rowspan="100">Etude</th>
            </tr>
            @foreach ($realisationmth as $relamth)
                <tr>
                    <td>{{ $relamth->NomCub }}</td>
                    <td>{{ $relamth->AnneeRealisation }}</td>
                    <td>{{ $relamth->CompagnieServise }}</td>
                    <td>{{ $relamth->Kilometrage }}</td>
                </tr>
            @endforeach

        </tbody>
        <tbody>
            <tr>
                <th rowspan="100">Acquisition</th>
            </tr>
        
            @foreach ($Acquisitionmth as $relamth)
                <tr>
                    <td>{{ $relamth->NomCub }}</td>
                    <td>{{ $relamth->AnneeRealisation }}</td>
                    <td>{{ $relamth->CompagnieServise }}</td>
                    <td>{{ $relamth->Kilometrage }}</td>
                </tr>
            @endforeach
        </tbody>

        {{-- <tr>
          <th colspan="4" style="text-align: center ;">total</th>
          <td>{{ $totalmth }}</td>
        </tr> --}}
    </table>

    <table style="margin-top: 50px" id="customers">
        <thead>
            <tr>
                <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">Réalisations
                    Etude géologiques et géotechniques  </th>
            </tr>
            <tr>
                <th>Désignation de l’étude</th>
                <th>Année de réalisation</th>
                <th>Compagnie de service</th>
                <th>Effort propre</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($EtudeGG as $EtudeGG)
                <tr>
                    <td>{{ $EtudeGG->Designation }}</td>
                    <td>{{ $EtudeGG->AnneeRealisation }}</td>
                    <td>{{ $EtudeGG->CompangnieServise }}</td>
                    <td>{{ $EtudeGG->EffortPropre }}</td>
                </tr>
            @endforeach

        </tbody>
        {{-- <tr>
            <th colspan="3" style="text-align: center">total</th>
            <td>{{ $EtudeGGsum }}</td>
          </tr> --}}


    
          <table style="margin-top: 50px" id="customers">
            <thead>
                <tr>
                    <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">Fracturation hydraulique</th>
                </tr>
                <tr>
                    <th>Nom du puits</th>
                    <th>Réservoirs concernés</th>
                    <th>Débit Initial</th>
                    <th>Débit Final</th>
                    <th>Année de réalisation</th>
                    <th>Effort propre</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach ($Fracturation as $Fracturation)
                    <tr>
                        <td>{{ $Fracturation->SiglePuit }}</td>
                        <td>{{ $Fracturation->NomReservoir }}</td>
                        <td>{{ $Fracturation->DebitInitial }}</td>
                        <td>{{ $Fracturation->DebitFinal }}</td>
                        <td>{{ $Fracturation->anneRelaisation }}</td>
                        <td>{{ $Fracturation->EffortPropre }}</td>
                    </tr>
                @endforeach
    
            </tbody>



            <table style="margin-top: 50px" id="customers">
                <thead>
                    <tr>
                        <th colspan="15" style="text-align: center;background-color: rgb(255, 106, 52);color:white">PUITS Exploration & Délinéation</th>
                    </tr>
                    <tr>
                        <th>Nom du puits</th>
                        <th>Année de Fin de sondage</th>
                        <th>Type(W/D)</th>
                        <th>Objectifs pétroliers</th>
                        <th>Etat actuel du puits</th>
                        <th>Resultat</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($puit as $puit)
                        <tr>
                            <td>{{ $puit->SiglePuit }}</td>
                            <td>{{ $puit->AnneeSondage }}</td>
                            <td>{{ $puit->TypePuit }}</td>
                            <td>{{ $puit->ObjectifPetrolier }}</td>
                            <td>{{ $puit->EtatPuit }}</td>
                            <td>{{ $puit->Resultat }}</td>
                        </tr>
                    @endforeach
        
                </tbody>
@endsection
