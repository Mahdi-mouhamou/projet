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

@if ($phase ==='phase1')
<table  id="customers" style="width:100%">
    <tr>
            <th class="text-center" colspan="12">Realisation de la {{ $phase }}</th>

    </tr>
    <tr>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 2D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 3D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation GG</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation potentiel</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puit Exploration</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puits Delination</td>
    </tr>
    <tr>
        <td>{{ $realisation2D }}</td>
        <td>{{ $realisation3D }}</td>
        <td>{{ $realisationGg }}</td>
        <td>{{ $realisationPot }}</td>
        <td>{{ $puitE }}</td>
        <td>{{ $puitD }}</td>
    </tr>
</table>  
<br><br><br>
<table  id="customers" style="width:100%">
    <tr>
            <th class="text-center" colspan="12">engagemment Effictife phase2 </th>

    </tr>
    <tr>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife 2D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife 3D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife GG</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife potentiel</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife puit Exploration</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife puits Delination</td>
    </tr>
    <tr>
        <td>{{ $effectif2D }}</td>
        <td>{{ $effectif3D }}</td>
        <td>{{ $effectifGg }}</td>
        <td>{{ $effectifpot }}</td>
        <td>{{ $effectifPuitE }}</td>
        <td>{{ $effectifPuitE }}</td>
    </tr>
</table>
 @elseif($phase ==='phase2')
 <table  id="customers" style="width:100%">
    <tr>
            <th class="text-center" colspan="12">Realisation de la {{ $phase }}</th>

    </tr>
    <tr>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 2D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 3D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation GG</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation potentiel</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puit Exploration</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puits Delination</td>
    </tr>
    <tr>
        <td>{{ $realisation2D }}</td>
        <td>{{ $realisation3D }}</td>
        <td>{{ $realisationGg }}</td>
        <td>{{ $realisationPot }}</td>
        <td>{{ $puitE }}</td>
        <td>{{ $puitD }}</td>
    </tr>
</table>  
<br><br><br>
<table  id="customers" style="width:100%">
    <tr>
            <th class="text-center" colspan="12">engagemment Effictife phase3 </th>

    </tr>
    <tr>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife 2D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife 3D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife GG</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife potentiel</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife puit Exploration</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Effictife puits Delination</td>
    </tr>
    <tr>
        <td>{{ $effectif2D }}</td>
        <td>{{ $effectif3D }}</td>
        <td>{{ $effectifGg }}</td>
        <td>{{ $effectifpot }}</td>
        <td>{{ $effectifPuitE }}</td>
        <td>{{ $effectifPuitE }}</td>
    </tr>
</table>
@elseif($phase==='phase3')
<table  id="customers" style="width:100%">
    <tr>
            <th class="text-center" colspan="12">Realisation de la {{ $phase }}</th>

    </tr>
    <tr>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 2D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation 3D</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation GG</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Realisation potentiel</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puit Exploration</td>
        <td style="color: white;background-color:#04AA6D; text-align: center">Nbr puits Delination</td>
    </tr>
    <tr>
        <td>{{ $realisation2D }}</td>
        <td>{{ $realisation3D }}</td>
        <td>{{ $realisationGg }}</td>
        <td>{{ $realisationPot }}</td>
        <td>{{ $puitE }}</td>
        <td>{{ $puitD }}</td>
    </tr>
</table>  
<br><br><br>
@endif


@endsection