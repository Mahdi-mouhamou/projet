@extends('voyager::master')
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 70%;
      margin: auto;
    }
    h2{
        color: black;
        
    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
      color: black;
    }
    td{
        text-align: center;
    }
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      color: rgb(0, 0, 0);
      width: 70%;
    }
    </style>

@section('content')

<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">fiche etude de Synthese du perimetre  </h2>
        <table id="customers">
            <thead>
                <tr>
                    <th style="   background-color: rgb(255, 106, 52);text-align: center ;color: white" colspan="4">informations relatives à l’environnement des HC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Nombre de puit positive</th>
                    <td>{{$puitPos}}</td>
                </tr>  
                <tr>
                    <th>Nombre de puit negative</th>
                    <td>{{$puitNeg}}</td>
                </tr>                
                <tr>
                    <th>Nombre de puit de decouvert</th>
                    <td>{{$puitDec}}</td>
                </tr> 
                <tr>
                    <th>Nombre dereservoir</th>
                    <td>{{$nbResevoir}}</td>
                </tr>
               
            </tbody>
               
            
        </table>
	</tbody>
</table>
<br><br>
<table id="customers">
    <thead>
        <tr>
            <th style="   background-color: rgb(255, 106, 52);text-align: center ;color: white" colspan="4">informations sur les volumes Hc</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($etude as $etude)
        <tr>
            <th>Nombre de prospect générer</th>
            <td>{{$etude->totalVolumeHuile}}</td>
        </tr>   
        <tr>
            <th>Total volumes mis en place (2P en MTEP) GAZ</th>
            <td>{{$etude->totalVolumeGaz}}</td>
        </tr>   
        <tr>
            <th>Total volumes mis en place (2P en MTEP) GAZ Associé </th>
            <td>{{$etude->totalVolumeGazAssocie}}</td>
        </tr>   
        <tr>
            <th>Total volumes mis en place (2P en MTEP) Huile </th>
            <td>{{$etude->totalVolumeHuile}}</td>
        </tr>   
        <tr>
            <th>Total volumes mis en place (2P en MTEP) Condensat</th>
            <td>{{$etude->totalVolumeCondensant}}</td>
        </tr>   
        <tr>
            <th>Total ressources escomptées GAZ (P50 MTEP)</th>
            <td>{{$etude->totalRessourcesEscompteGaz}}</td>
        </tr>        
        <tr>
            <th>Total ressources escomptées HUILE (P50 MTEP)</th>
            <td>{{$etude->totalRessourcesEscompteHuile}}</td>
        </tr>
        <tr>
            <th>Nombre de lead reconnu</th>
            <td>{{$etude->nbLead}}</td>
        </tr>
        @endforeach
    </tbody>
       
    
</table>
</tbody>
</table>
@endsection