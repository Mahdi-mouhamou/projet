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
      width: 50%;
    }
    </style>
    @php
    $cpt= count($gisement);
     
    @endphp
@section('content')

<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">fiche renseignement generale du perimetre  </h2>
        <table id="customers">
            <thead>
                <tr>
                    <th style="  background-color: #04AA6D;text-align: center ;color: white" colspan="4">Informations géographiques</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perimetre as $perimetre)
                    
         
                <tr>
                    <th>id</th>
                    <td>{{$perimetre->id}}</td>
                </tr>
                <tr>
                    <th>Nom perimetre</th>
                    <td>{{$perimetre->NomPerimetre}}</td>
                </tr>
                <tr>
                    <th>Asset</th>
                    <td>{{$perimetre->Asset}}</td>
                </tr>
                <tr>
                    <th>Departement</th>
                    <td>{{$perimetre->Departement}}</td>
                </tr>
                <tr>
                    <th>statut Contrat</th>
                    <td>{{$perimetre->Statut}}</td>
                </tr>
                <tr>
                    <th>Bassin</th>
                    <td>{{$perimetre->Bassin}}</td>
                </tr>
                <tr>
                    <th>block</th>
                    <td>{{$perimetre->Block}}</td>
                </tr>
                <tr>
                    <th>Classification</th>
                    <td>{{$perimetre->Classification}}</td>
                </tr>
                <tr>
                    <th>Superficie</th>
                    <td>{{$perimetre->Superficie}}</td>
                </tr>
                @endforeach
            </tbody>
               
            
        </table>
	</tbody>
</table>

<table style="margin-top: 50px" id="customers">
    <thead>
        <tr>
            <th >surface</th>
            <th  >Nom du gisement </th>
            <th >Superficie Km²</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th rowspan="100">gisement</th>
        </tr>
        @foreach ($gisement as $gisement)
       <tr>
        <td>{{$gisement->NomGisement}}</td>
        <td>{{$gisement->Superficie}}</td>
        </tr>
       @endforeach
     
    </tbody>
</table>


@endsection