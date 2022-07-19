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
    $perimetre = collect(json_decode($perimetre, true));
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
      @if ($routeName=='fiche.index')
      <h2 class="text-center">Listes des fiche de Synthese PLF</h2>
      @endif
      @if ($routeName=='renseignement')
      <h2 class="text-center">Listes des fiche de Synthese renseignement</h2>
      @endif 
    
    {{-- <h2 class="text-center">Listes des fiche de Synthese</h2> --}}
    
    <table id="customers">
      <tr>
        <th>Nom de perimetre</th>
        {{-- <th>Asset</th> --}}
        {{-- <th>Departement</th> --}}
        {{-- <th>statut</th> --}}
        <th>Actions</th>
      </tr>
      
      @foreach ($perimetre as $item)
      <tr>
        <td>{{$item['NomPerimetre']}}</td>
        {{-- <td> {{$item ['Asset']}}</td> --}}
        {{-- <td>{{$item ['Departement']}}</td> --}}
        {{-- <td>{{$item ['Statut']}}</td> --}}
        @if ($routeName=='fiche.index')
        <td><a class="btn btn-sm btn-danger center  " style="width: 50%;background-color: rgb(0, 0, 0)" href=" {{route('fiche.detaille',['id'=>$item ['contrat_id']])}} ">consulter la fiche</a></td>
        @endif
        @if($routeName=='renseignement')
        <td><a class="btn btn-sm btn-danger center " style="width: 50%;background-color: rgb(0, 0, 0)" href=" {{route('detailleRenseignement',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif
      </tr>
      @endforeach
    </table>
    
       


@endsection