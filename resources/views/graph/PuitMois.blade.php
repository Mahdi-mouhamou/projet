@extends('voyager::master')

@section('content')
<div style="width: 80%;margin:50px;">
    <canvas style=" margin-left: 90px;" id="myChart" role="img" aria-label="chart"></canvas> 
</div>
 <div style="width: 50%;margin:50px;">
    <canvas id="myChartP" role="img" aria-label="chart"></canvas> 
 </div> 
 <div style="width: 50%;margin:50px;">
    <canvas id="myChartpuit" role="img" aria-label="chart"></canvas> 
 </div>  
 <div style="width: 80%;margin:20px">
 <canvas id="myChartline" role="img" aria-label="chart"></canvas> 
 </div>
  <div style="width: 80%;margin:20px">
 <canvas id="myChartline3D" role="img" aria-label="chart"></canvas> 
 </div>

 <script src="{{ asset('chart.js/chart.js') }}"></script>

<script>
var ctx = document.getElementById('myChart');
var labels =  {{ Js::from($data['perimetre']) }};
var puits =  {{ Js::from($data['puit'])}};
var myChart = new Chart(ctx,{
 type:"bar",
 data:{
     labels:labels,
     datasets:[{
        
         data:puits,
         backgroundColor:["crimson","red","lightblue","lightgreen"],
         label: 'Total des puit par perimetre',
     }],
 }
});
var ctx = document.getElementById('myChartpuit');
var labels =  {{ Js::from($dataPuit['perimetre']) }};
var puits =  {{ Js::from($dataPuit['puitp'])}};
var myChart = new Chart(ctx,{
 type:"bar",
 data:{
     labels:labels,
     datasets:[{
        
         data:puits,
         backgroundColor:["crimson","red","lightblue","lightgreen"],
         label: 'Nombre de puit positive par perimetre',
     }],
 }
});

var ctx = document.getElementById('myChartP');
var labels =  {{ Js::from($dataP['anne']) }};
var puits =  {{ Js::from($dataP['nbp'])}};
var myChart = new Chart(ctx,{
 type:"pie",
 data:{
     labels:labels,
     datasets:[{
        
         data:puits,
         backgroundColor:["green","blue","lightblue","lightgreen"],
        hoverOffset:30,
     }],
 }
});

var line = document.getElementById('myChartline');
var labels =  {{ Js::from($data2D['month']) }};
// var labels =  ["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juilet","Aout","Septembre","Octobre","Novembre","Decembre"];
var data =  {{ Js::from($data2D['somme'])}};
var data2DAc =  {{ Js::from($data2DAc['somme'])}};
var data2DART =  {{ Js::from($data2DART['somme'])}};


var myChartline = new Chart(line,{
 type:"line",
 data:{
    labels:labels,
     datasets:[{
         data:data,
         backgroundColor:["red"],
         label:"Traitement sismique 2D",
         borderColor:"red",
         tension:0.4,
         
     },
     {
         data:data2DAc,
         backgroundColor:["lightgreen"],
         label:"Acquisition sismique 2D",
         borderColor:"green",
         tension:0.4,
     },
    {
        data:data2DART,
         backgroundColor:["blue"],
         label:"Retraitement sismique 2D",
         borderColor:"blue"  ,
         tension:0.4,
    }
    
    
    ],
     
     
 }
});
var line = document.getElementById('myChartline3D');
var labels =  {{ Js::from($data2D['month']) }};
var data =  {{ Js::from($data3DT['somme'])}};
var data2DAc =  {{ Js::from($data3DAc['somme'])}};
var data2DART =  {{ Js::from($data3DRT['somme'])}};


var myChartline3D = new Chart(line,{
 type:"line",
 data:{
    labels:labels,
     datasets:[{
         data:data,
         backgroundColor:["red"],
         label:"Traitement sismique 2D",
         borderColor:"red",
         tension:0.4,
         
     },
     {
         data:data2DAc,
         backgroundColor:["lightgreen"],
         label:"Acquisition sismique 2D",
         borderColor:"green",
         tension:0.4,
     },
    {
        data:data2DART,
         backgroundColor:["blue"],
         label:"Retraitement sismique 2D",
         borderColor:"blue",
         tension:0.4,  
    }
    
    
    ],
     
     
 }
});
</script>
@endsection