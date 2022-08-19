@extends('voyager::master')

@section('content')
@if ($value=="coute")
   <div style="width: 80%;margin:50px;">
    <canvas style=" margin-left: 90px;" id="myChart" role="img" aria-label="chart"></canvas> 
</div> 
<script>
    var ctx = document.getElementById('myChart');
    var labels =  {{ Js::from($data['perimetre']) }};
    var coute =  {{ Js::from($data['coute'])}};
    var myChart = new Chart(ctx,{
     type:"bar",
     data:{
         labels:labels,
         datasets:[{
             data:coute,
             backgroundColor:["crimson","red","lightblue","lightgreen"],
             label: 'Total des coutes par perimetre',
         }],
     }
    });
</script>
@endif
@if($value==="sismique")

<div style="width: 80%;margin:50px;">
    <canvas style=" margin-left: 90px;" id="myChart2D3D" role="img" aria-label="chart"></canvas> 
</div>

<script src="{{ asset('chart.js/chart.js') }}"></script>
<script>
var ctx = document.getElementById('myChart2D3D');
var labels =  {{ Js::from($dataSismique['perimetre']) }};
var data2D =  {{ Js::from($dataSismique['2D'])}};
var data3D =  {{ Js::from($dataSismique['3D'])}};
var myChart2D3D = new Chart(ctx,{
 type:"bar",
 data:{
     labels:labels,
     datasets:[{
         data:data2D,
         backgroundColor:["red"],
         label: '2D',
     },
     {
         data:data3D,
         backgroundColor:["lightgreen"],
         label: '3D',
     },
    ],
 }
});
</script>
@endif
@endsection