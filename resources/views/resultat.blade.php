@extends('voyager::master')
@section('content')
@php
    $json='{
        
        "option1": "Est",
        "option2": "West",
        "option3": "Nord",
        "option4": "Sud"  
    }';
    $maCollection = collect(json_decode($json, true));

@endphp
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
    </head>
    <body>
    
    <h2 class="text-center">Listes des fiche de Synthese</h2>
    
    <table id="customers">
      <tr>
        <th>Nom de perimetre</th>
        <th>Asset</th>
        <th>Departement</th>
        <th>statut</th>
        <th>Actions</th>
      </tr>
      
      @foreach ($perimetre as $item)
      <tr>
        <td>{{$item->NomPerimetre}}</td>
        <td> {{$item->Asset}}</td>
        <td>{{$item->Departement}}</td>
        <td>{{$item->Statut}}</td>
        <td>
        <a class="btn btn-sm btn-danger  " style="width: 33%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase1'])}} ">phase1</a>
        <a class="btn btn-sm btn-danger  " style="width: 33%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase2'])}} ">phase2</a>
        <a class="btn btn-sm btn-danger  " style="width: 32%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase3'])}} ">phase3</a></td>
      </tr>
      @endforeach
    </table>
    
       


@endsection