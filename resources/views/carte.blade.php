@extends('voyager::master')

@section('content')
<div style="width: 80%;margin:50px;">
    <canvas style=" margin-left: 90px;" id="myChart" role="img" aria-label="chart"></canvas> 
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
</script>

@endsection