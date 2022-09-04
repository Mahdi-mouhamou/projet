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
      @if ($routeName=='fiche.index')
      <h2 class="text-center" >Listes des fiche de Synthese PLF</h2>
      @endif
      @if ($routeName=='renseignement')
      <h2 class="text-center">Listes des fiche de Synthese renseignement</h2>
      @endif 
      @if ($routeName=='FicheRealisation')
      <h2 class="text-center">Listes des fiche de Synthese Asset</h2>
      @endif
     @if ($routeName=='FicheFinance')
     <h2 class="text-center">Listes des fiche de Synthese Finance</h2>
      @endif
      @if ($routeName=='statistique')
     <h2 class="text-center">Liste des perimetres</h2>
      @endif
      @if ($routeName=='FicheEtudeAvancement')
      <h2 class="text-center">Listes des fiche de Synthese etude avancement</h2>
      @endif

    {{-- <h2 class="text-center">Listes des fiche de Synthese</h2> --}}
    
    <table id="customers">
      <tr>
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Nom de perimetre</th>
        {{-- <th>Asset</th> --}}
        {{-- <th>Departement</th> --}}
        {{-- <th>statut</th> --}}
        <th style=" background-color: rgb(255, 106, 52);color: #ffffff">Actions</th>
      </tr>
      
      @foreach ($perimetre as $item)
      <tr>
        {{-- {{dd($item)}} --}}
        <td>{{$item['NomPerimetre']}}</td>
        {{-- <td> {{$item ['Asset']}}</td> --}}
        {{-- <td>{{$item ['Departement']}}</td> --}}
        {{-- <td>{{$item ['Statut']}}</td> --}}
        @if ($routeName=='fiche.index')
        <td><a class="btn btn-sm btn-danger center  " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('fiche.detaille',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif
        @if($routeName=='renseignement')
        <td><a class="btn btn-sm btn-danger center " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('detailleRenseignement',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif
        @if($routeName=='FicheRealisation')
        <td><a class="btn btn-sm btn-danger center " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('detailleFicheRealisation',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif
        @if ($routeName=='FicheFinance')
        <td><a class="btn btn-sm btn-danger center " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('detailleFicheFinance',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif 
        @if ($routeName=='FicheEtudeAvancement')
        <td><a class="btn btn-sm btn-danger center " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('detailleFicheEtudeAvancement',['id'=>$item ['id']])}} ">consulter la fiche</a></td>
        @endif
        @if ($routeName=='statistique')
        <td><a class="btn btn-sm btn-danger center " style="width: 30%;background-color: rgb(0, 0, 0)" href=" {{route('graphDetaille',['id'=>$item ['id']])}} ">consulter</a></td>
        @endif
      </tr>
      @endforeach
      
    </table>
    
       


@endsection