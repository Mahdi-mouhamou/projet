@extends('voyager::master')
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin: auto;
    }
    h2{
        color: black
    }
    
    #customers td, #customers th {
      border: 1px solid #ffffff;
      background-color: #f2f2f2;
      padding: 8px;
      color: black;
    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: rgb(255, 106, 52);
      color: white;
    }
    </style>
    
@section('content')
    @php
    $contrat = collect(json_decode($contrat, true));
    $perimetre = collect(json_decode($perimetre, true));
    $avenant = collect(json_decode($avenant, true));
    $programme1 = collect(json_decode($programme1, true));
    $programme2 = collect(json_decode($programme2, true));
    $programme3 = collect(json_decode($programme3, true));
    // dd($contrat);
    @endphp

    @foreach ($perimetre as $perimetre)
         <h1 style="margin-bottom: 40px;color: rgb(0, 0, 0);text-align:center;font-family:fangsong">Le perimetre {{$perimetre['NomPerimetre']}}</h1>
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
        <tr>
            <td>Date d'echeance du contrat</td>
            <td>{{ $items['DateEcheance'] }}</td>
        </tr>
    </table>
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
      <th colspan="2">puit</th>
    </tr>
    <tr>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>
      <td>Sismique 2D</td>
      <td>Sismique 3D</td>      
      <td>Puit d'exploration</td>
      <td>puit Delination</td>
    </tr>
    @foreach ($contrat as $items)
    <tr>
        <td>{{ $items['Eng1Phase2D'] }}</td>
        <td>{{ $items['Eng1Phase3D'] }}</td>
        <td>{{ $items['Eng2Phase2D'] }}</td>
        <td>{{ $items['Eng2Phase3D'] }}</td>
        <td>{{ $items['Eng3Phase2D'] }}</td>
        <td>{{ $items['Eng3Phase3D'] }}</td>
        <td>{{ $items['engPuitE'] }}</td>
        <td>{{ $items['engPuitD'] }}</td>
    </tr>
   @endforeach
  </table>
  <br>
  <br>
  <table  id="customers" style="width:100%">
    <tr>
        
            <th class="text-center" colspan="8">Avenants  Demandes d’accord ALNAFT </th>
    </tr>
    <tr>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">Motifs du demande</td>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">Nom de la surface</td>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">superficie</td>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">dateEnvoie</td>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">dateReponse</td>
        <td style="color: white;background-color: rgb(255, 106, 52); text-align: center">accord</td>
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
    @endforeach

    <br><br>
<table id="customers"  style="width:60%;background-color: #f2f2f2; color: black ;text-align:center">
    <thead>
        <tr>
            <th colspan="2" style="margin-bottom: 40px;color: rgb(255, 255, 255);text-align:center;">plan de devlopement de la premier phase</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($programme1 as $programme1)
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">id</th>
            <td style="text-align:center">{{$programme1['id']}}</td>
        </tr>
        
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 2D</th>
            <td style="text-align:center">{{$programme1['AcusSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 3D</th>
            <td style="text-align:center">{{$programme1['AcusSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 2D</th>
            <td style="text-align:center">{{$programme1['TraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 3D</th>
            <td style="text-align:center">{{$programme1['TraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 2D</th>
            <td style="text-align:center">{{$programme1['RtraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 3D</th>
            <td style="text-align:center">{{$programme1['RtraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit d'exploration</th>
            <td style="text-align:center">{{$programme1['NbPuitExploration']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit deliniation</th>
            <td style="text-align:center">{{$programme1['NbPuitDeliniation']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Methode potentiel</th>
            <td style="text-align:center">{{$programme1['MethodePotentiel']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de prospect</th>
            <td style="text-align:center">{{$programme1['NbProspectG']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Etude GG</th>
            <td style="text-align:center">{{$programme1['EtudeGG']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table  id="customers" style="width:60%">
    <tr>
            <th class="text-center" colspan="12">engagemment Effictife phase2 </th>
    </tr>
    <tr>
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Acquisition 2D</th>
        <td style="text-align: center ">{{ $effectif2DA }}</td>
    </tr>
    <tr> 
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Traitement 2D</th>
        <td style="text-align: center ">{{ $effectif2DT }}</td>
    </tr>
    <tr>  
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Retraitement 2D</th>
        <td style="text-align: center ">{{ $effectif2DRT }}</td>
    </tr> 
    <tr>
         
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Acquisition 2D</th>
        <td style="text-align: center ">{{ $effectif3DA }}</td>
     </tr>   
     <tr> 
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Traitement 2D</th>
        <td style="text-align: center ">{{ $effectif3DT }}</td>
     </tr>   
     <tr> 
         <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Retraitement 2D</th>
        <td style="text-align: center ">{{ $effectif3DRT }}</td>
     </tr>  
     <tr>  
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife GG</th>
        <td style="text-align: center ">{{ $effectifGg }}</td>
     </tr>   
     <tr>
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife potentiel</th>
        <td style="text-align: center ">{{ $effectifpot }}</td>
     </tr> 
     <tr> 
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife puit Exploration</th>
        <td style="text-align: center ">{{ $effectifPuitE }}</td>
     </tr>  
     <tr>
        <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife puits Delination</th>
        <td style="text-align: center ">{{ $effectifPuitE }}</td>
    </tr>

</table>

    <table style="width:60%;" id="customers" style="width:50% ;background-color: #f2f2f2; color: black ;">
    <thead>
        <tr>
            <th colspan="2" style="margin-bottom: 40px;color: rgb(255, 255, 255);text-align:center;">plan de devlopement de la deuxieme phase</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($programme2 as $programme2)
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">id</th>
            <td style="text-align:center">{{$programme2['id']}}</td>
        </tr>
        
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 2D</th>
            <td style="text-align:center">{{$programme2['AcusSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 3D</th>
            <td style="text-align:center">{{$programme2['AcusSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 2D</th>
            <td style="text-align:center">{{$programme2['TraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 3D</th>
            <td style="text-align:center">{{$programme2['TraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 2D</th>
            <td style="text-align:center">{{$programme2['RtraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 3D</th>
            <td style="text-align:center">{{$programme2['RtraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit d'exploration</th>
            <td style="text-align:center">{{$programme2['NbPuitExploration']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit deliniation</th>
            <td style="text-align:center">{{$programme2['NbPuitDeliniation']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Methode potentiel</th>
            <td style="text-align:center">{{$programme2['MethodePotentiel']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de prospect</th>
            <td style="text-align:center">{{$programme2['NbProspectG']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Etude GG</th>
            <td style="text-align:center">{{$programme2['EtudeGG']}}</td>
        </tr>

        @endforeach
    </tbody>
    </table>
    <table  id="customers" style="width:60%">
        <tr>
                <th class="text-center" colspan="12">engagemment Effictife phase3 </th>
        </tr>
        <tr>
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Acquisition 2D</th>
            <td style="text-align: center">{{ $effectif2DAP2 }}</td>
        </tr>
        <tr> 
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Traitement 2D</th>
            <td style="text-align: center">{{ $effectif2DTP2 }}</td>
        </tr>
        <tr>  
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Retraitement 2D</th>
            <td style="text-align: center">{{ $effectif2DRTP2 }}</td>
        </tr> 
        <tr>
             
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Acquisition 2D</th>
            <td style="text-align: center">{{ $effectif3DAP2 }}</td>
         </tr>   
         <tr> 
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Traitement 2D</th>
            <td style="text-align: center">{{ $effectif3DTP2 }}</td>
         </tr>   
         <tr> 
             <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Retraitement 2D</th>
            <td style="text-align: center">{{ $effectif3DRTP2 }}</td>
         </tr>  
         <tr>  
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife GG</th>
            <td style="text-align: center">{{ $effectifGgP2 }}</td>
         </tr>   
         <tr>
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife potentiel</th>
            <td style="text-align: center">{{ $effectifpotP2 }}</td>
         </tr> 
         <tr> 
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife puit Exploration</th>
            <td style="text-align: center">{{ $effectifPuitEP2 }}</td>
         </tr>  
         <tr>
            <th style="color: white; width: 50% ;background-color: #f2f2f2;color: black ;">Effictife puits Delination</th>
            <td style="text-align: center">{{ $effectifPuitEP2 }}</td>
        </tr>

    </table>

    <table style="width:60%;" id="customers" style="width:50% ;background-color: #f2f2f2; color: black ;">
    <thead>
        <tr>
            <th colspan="2" style="margin-bottom: 40px;color: rgb(255, 255, 255);text-align:center;">plan de devlopement de la troisieme phase</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($programme3 as $programme3)
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">id</th>
            <td style="text-align:center">{{$programme3['id']}}</td>
        </tr>
        
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 2D</th>
            <td style="text-align:center">{{$programme3['AcusSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Acquisition 3D</th>
            <td style="text-align:center">{{$programme3['AcusSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 2D</th>
            <td style="text-align:center">{{$programme3['TraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Traitement 3D</th>
            <td style="text-align:center">{{$programme3['TraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 2D</th>
            <td style="text-align:center">{{$programme3['RtraitSismique2D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Retraitement 3D</th>
            <td style="text-align:center">{{$programme3['RtraitSismique3D']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit d'exploration</th>
            <td style="text-align:center">{{$programme3['NbPuitExploration']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de puit deliniation</th>
            <td style="text-align:center">{{$programme3['NbPuitDeliniation']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Methode potentiel</th>
            <td style="text-align:center">{{$programme3['MethodePotentiel']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Nombre de prospect</th>
            <td style="text-align:center">{{$programme3['NbProspectG']}}</td>
        </tr>
        <tr >
            <th style ="width:50% ;background-color: #f2f2f2; color: black ;">Etude GG</th>
            <td style="text-align:center">{{$programme3['EtudeGG']}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    {{-- <table  id="customers" style="width:100%"> --}}
 

@endsection
