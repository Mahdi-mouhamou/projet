@extends('voyager::master')
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    h2{
        color: black
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
      color: black;
    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
    </style>
    
@section('content')
    @php
    $json = '{
            "option1": "oui",
            "option2": "non"
        }';
    $accord = collect(json_decode($json, true));

    $json1 = '{
            "option1": "demande adjonction surface libre",
            "option2": "prorogation de surface de découvert",
            "option3": "extension de la période de prorogation",
            "option4": "Intégration des niveaux géologiques",
            "option5": "Intégration de surfaces de découvertes libres"
        }';
    $motif = collect(json_decode($json1, true));
    $contrat = collect(json_decode($contrat, true));
    $perimetre = collect(json_decode($perimetre, true));
    $avenant = collect(json_decode($avenant, true));
    // dd($contrat);
    @endphp

    @foreach ($perimetre as $perimetre)
         <h1 style="color: black;text-align:center;">Le perimetre {{$perimetre['NomPerimetre']}}</h1>
    @endforeach
       
    <table  id="customers" style="width:100%">
        <tr>
            @foreach ($contrat as $items)
            
                <th class="text-center" colspan="2">Informations sur le contrat N° {{ $items['id'] }}</th>

        </tr>
        <tr>
            <td>Date de signature du contrat</td>
            <td>{{ $items['DateSingatureContrat'] }}</td>
        </tr>
        <tr>
            <td>Date d’entrée en vigueur du contrat</td>
            <td>{{ $items['DateEntrerVigure'] }}</td>
        </tr>
        <tr>
            <td>Période de recherche actuelle</td>
            <td>{{ $items['periodeRecherche'] }}</td>
        </tr>
        <tr>
            <td>Statut actuel du contrat</td>
            <td>{{ $items['statut_Contrat'] }}</td>
        </tr>
    </table>
    <br>
    
    <table  id="customers" style="width:100%">
        <tr>
            
                <th class="text-center" colspan="8">Avenants  Demandes d’accord ALNAFT </th>
        </tr>
        <tr>
            <td style="color: white;background-color:#04AA6D; text-align: center">Motifs du demande</td>
            <td style="color: white;background-color:#04AA6D; text-align: center">Nom de la surface</td>
            <td style="color: white;background-color:#04AA6D; text-align: center">superficie</td>
            <td style="color: white;background-color:#04AA6D; text-align: center">dateEnvoie</td>
            <td style="color: white;background-color:#04AA6D; text-align: center">dateReponse</td>
            <td style="color: white;background-color:#04AA6D; text-align: center">accord</td>
            {{-- <td>numero du contrat</td> --}}
          
            
    </tr>
        @foreach ($avenant as $items)
        <tr>
            <td>{{ $items['motifDemande'] }}</td> 
            <td>{{ $items['NomSurface'] }}</td>
            <td>{{ $items['superficie'] }}</td>
            <td>{{ $items['dateEnvoie'] }}</td>
            <td>{{ $items['dateReponse'] }}</td>
            <td>{{ $items['accord'] }}</td>
            {{-- <td>{{ $items['contrat_id'] }}</td> --}}
        
        </tr>
        @endforeach
    </table>
    <br>
  <table  id="customers" style="width:100%">
    <tr>
        @foreach ($contrat as $items)
        <th class="text-center" colspan="12">Les engagemment du contrat N° {{ $items['id'] }}</th>
        @endforeach
    </tr>
    
    <tr>
      <th colspan="2">Phase 1</th>
      <th colspan="2">Phase 2</th>
      <th colspan="2">Phase 3</th>
    </tr>
    <tr>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>
    </tr>
    @foreach ($contrat as $items)
    <tr>
        <td>{{ $items['Eng1Phase2D'] }}</td>
        <td>{{ $items['Eng1Phase3D'] }}</td>
        <td>{{ $items['Eng2Phase2D'] }}</td>
        <td>{{ $items['Eng2Phase3D'] }}</td>
        <td>{{ $items['Eng3Phase2D'] }}</td>
        <td>{{ $items['Eng3Phase3D'] }}</td>
    </tr>
   @endforeach
  </table>

    @endforeach
@endsection
