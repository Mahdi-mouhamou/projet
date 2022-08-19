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
        width: 90%;
        margin: auto;
        
    }

    h2 {
        color: black;
        margin-bottom: 40px;
        color: black;
        text-align:center;
        font-family:fangsong;

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
        color: rgb(255, 255, 255);
       

    }
    </style>
    </head>
    <body>
    
    <h2 class="text-center">Resultat des realisation Des perimetre</h2>
    
    <table id="customers">
      <tr>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Nom de perimetre</th>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Asset</th>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Departement</th>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">statut</th>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Actions</th>
      </tr>
      
      @foreach ($perimetre as $item)
      <tr>
        <td>{{$item->NomPerimetre}}</td>
        <td> {{$item->Asset}}</td>
        <td>{{$item->Departement}}</td>
        <td>{{$item->Statut}}</td>
        <td>
        <a class="btn btn-sm btn-danger  " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase1'])}} ">phase1</a>
        <a class="btn btn-sm btn-danger  " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase2'])}} ">phase2</a>
        <a class="btn btn-sm btn-danger  " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('resultatPhase',['id'=>$item->contrat_id,'phase'=>'phase3'])}} ">phase3</a></td>
      </tr>
      @endforeach
    </table>
    
       


@endsection