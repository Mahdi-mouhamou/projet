@extends('voyager::master')
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    h2 {
        color: black
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        color: black;
    }

    #customers tr:nth-child(even) {
        background-color: #ffffff;
    }

    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        text-align: center;
        background-color: rgb(255, 106, 52);
        color:white;
    }
</style>

@php
$json = '{
        "option1": "1",
        "option2": "2",
        "option2": "3"
    }';
$phase = collect(json_decode($json, true));
// $programme = collect(json_decode($programme, true));
@endphp
@section('content')
<h2 style="margin-bottom: 30px;;color: black;text-align:center;font-family:fangsong">Detaille de la @foreach ($programme as $items)  {{ $items->phase }} @endforeach du plan de devlopement @foreach ($perimetre as $items)
   du perimetre {{ $items->NomPerimetre }} 
    @endforeach
</h2><br>
<table id="customers" style="width:100%">
    <tr>
        <th class="text-center" colspan="8">Date prevu de debut et fin </th>
    </tr>
    <tr>
        <th >Date debut</th>
        <th >Date fin</th>
    </tr>
 
    <tr>
          @foreach ($programme as $items)
            <td>{{ $items->dateD }}</td>
            <td>{{ $items->dateF }}</td>
          @endforeach
    </tr>
</table>
<br>
    <table id="customers" style="width:100%">
        <tr>
            <th class="text-center" colspan="8">Realisation Sismique </th>
        </tr>
        <tr>
            <th colspan="2">Aquisition</th>
            <th colspan="2">Traitement</th>
            <th colspan="2">Retraitement</th>
        </tr>
        <tr>
            <td>Sismique 2D</td>
            <td>Sismique 3D</td>
            <td>Sismique 2D</td>
            <td>Sismique 3D</td>
            <td>Sismique 2D</td>
            <td>Sismique 3D</td>
        </tr>
        @foreach ($programme as $items)
            <tr>
               
                    <td>{{ $items->AcusSismique2D }}</td>
                    <td>{{ $items->AcusSismique3D }}</td>
                    <td>{{ $items->TraitSismique2D }}</td>
                    <td>{{ $items->TraitSismique3D }}</td>
                    <td>{{ $items->RtraitSismique2D }}</td>
                    <td>{{ $items->RtraitSismique3D }}</td>
          
            </tr>
    </table>
        @endforeach
        <br><br>
        <table id="customers" style="width:100%">
            <tr>

                <th class="text-center" colspan="8">Objectifs Methode potentiel & Nombre de puit & fracturation & Etude
                    G&G de La premiere Phase </th>
            </tr>
            <tr>
                <th colspan="">Nombre de puit d'exploration</th>
                <th colspan="">Nombre de puit deliniation</th>
                <th colspan="">Methode potentiel</th>
                <th colspan="">fracturation hydraulique</th>
                <th colspan="">Etude G&G</th>
                <th colspan="">Nombre de prospect</th>
            </tr>
          
            @foreach ($programme as $items)
                <tr>
       
                        <td>{{ $items->NbPuitExploration }}</td>
                        <td>{{ $items->NbPuitDeliniation }}</td>
                        <td>{{ $items->MethodePotentiel }}</td>
                        <td>{{ $items->FractHydraulique }}</td>
                        <td>{{ $items->EtudeGG }}</td>
                        <td>{{ $items->NbProspectG }}</td>
                
                </tr>
        </table>
            @endforeach
        @endsection
