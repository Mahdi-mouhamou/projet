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
      border: 1px solid rgb(255, 255, 255);
      padding: 8px;
      color: black;
    }
    td{
        text-align: center;
    }
    #customers tr:nth-child(even){background-color: #ffffff;}
    
    /* #customers tr:hover {background-color:  #82e8c3;color: white;} */
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      color: rgb(0, 0, 0);
      width: 50%;
    }
    </style>


@section('content')


<h2 style="margin-bottom: 40px;;color: black;text-align:center;font-family:fangsong">historique des modification  </h2>
{{-- @foreach ($hist as $item)
    <h1>{{ $item->operation }}</h1>
    @php
        $maCollection = collect(json_decode($item->data, true));
        $maCollection->toArray();
    @endphp
    <h5>{{$maCollection['id']}}</h5>
@endforeach --}}


<table  id="customers" style="width:100%">

    <tr >
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center"> ID</td>
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center">Model</td>
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center">User Name</td>
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center">Date</td>
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center">data id</td>
        <td style="color: white; background-color: rgb(255, 106, 52); text-align: center">Action</td>
    </tr>
    @foreach ($hist as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->model }}</td>
        <td>{{ $item->user }}</td>
        <td>{{ $item->date }}</td>
        {{-- <td>{{ $item->operation }}</td> --}}
    @php
        $maCollection = collect(json_decode($item->data, true));
        $maCollection->toArray();
    @endphp
    <td>{{$maCollection['id']}}</td>
   {{-- <td> <a class="btn btn-sm btn-danger  " style="width: 50%;background-color: rgb(0, 0, 0)" href=" {{ route('showData',['id'=>$item->id,'model'=>$item->model])}} ">Voir data</a></td> --}}
   <td> <a  href=" {{ route('showData',['id'=>$item->id,'model'=>$item->model])}} ">Voir data</a></td>
@endforeach
    </tr>
</table>  
@endsection