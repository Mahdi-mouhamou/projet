@extends('voyager::master')

@section('content')

<style>
    
 .cards{
    width: 100%;
    padding: 35px20px;
    display: grid;
    grid-template-columns: repeat(4,1fr);
    grid-gap: 20px;
    margin-left: 12px;
 }
 .cards .card{
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border-radius: 10px;
    box-shadow: 3px 3px 3px  rgba(0,0,0 , 0.3);
  background-color: #ebf2fa;
    /* background-color: #f4f4f9; */
 }
 .number{
    font-size: 35px;
    font-weight: 500;
    color: #000000;
 }
 .card-name{
    color: #000000;
    font-weight: 600;
 }
 .charts{
    margin-left: 10px;
    margin-top: 15px;
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 20px;
    width: 100%;
    padding: 10px;
    padding-top: 0;
 }
 .chart{
   background: #fff;
   padding: 10px;
   border-radius: 10px;
   box-shadow: 4px 4px 4px  rgba(0,0,0 , 0.3);
   /* background-color: #ebf2fa; */
 }
 .icon-box{
    font-size: 55px;
    color: #000000;
 }
</style>
{{-- <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }
    
    .topnav {
    width: 100%;
      overflow: hidden;
      background-color: rgb(0, 0, 0);
      position: fixed;
    }
    
    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }
    
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }
    
    .topnav a.active {
      background-color: #f77315;
      color: white;
    }
    </style>
    </head>
    <body>
    
    <div class="topnav">
      <a class="active" href="#home">Home</a>
      <a href="#news">News</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
    </div>
    
    <div style="padding-left:16px">
      <h2>Top Navigation Example</h2>
      <p>Some content..</p>
    </div> --}}
{{-- <div style=" display: flex;" class="">
<div style="border: solid black ; border-radius: 50px;; background-color: #f1f1f1;margin: 30px;padding: 40px;font-size: 14px;" class="">
    mahdihahaDDDDDDhjsdhdhs
</div>
<div style="border: solid black ;  border-radius: 50px;;background-color: #f1f1f1;margin: 30px;padding: 40px;font-size: 14px;" class="">
    mahdihahaDDDDDDjkcvhdfd
</div>
<div style="border: solid black ;  border-radius: 50px;;background-color: #f1f1f1;margin: 30px;padding: 40px;font-size: 14px;" class="">
    mahdihahaDDDDDDdfgdfgdf
</div>

</div> --}}
<div class="main">
    <div class="cards">
        <div class="card">
            <div class="card-content">
                <div class="number">{{$NbPerimetre}}</div>
                <div class="card-name">perimetre</div>
            </div>
            <div class="icon-box">
                <i class="voyager-list"></i>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="number">{{$NbPerimetre}}</div>
                <div class="card-name">perimetre</div>
            </div>
            <div class="icon-box">
                <i class="voyager-list"></i>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="number">{{$NbPerimetre}}</div>
                <div class="card-name">perimetre</div>
            </div>
            <div class="icon-box">
                <i class="voyager-list"></i>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="number">{{$NbPerimetre}}</div>
                <div class="card-name">perimetre</div>
            </div>
            <div class="icon-box">
                <i class="voyager-list"></i>
            </div>
        </div>
    </div>
    <div class="charts">
        <div class="chart">
            <h2 style="color: #000000;text-align: center ">
              Totale des coutes par perimetre
            </h2>
            <div style="">
                <canvas style="" id="myChart" role="img" aria-label="chart"></canvas> 
            </div>
        </div>
        <div class="chart" id="circle-chart">
            <h2 style="color: #000000;text-align: center ;">
                Pourcentage des coute 
                <div style="">
                    <canvas style=" " id="myChartD" role="img" aria-label="chart"></canvas> 
                </div>
            </h2>
        </div>
    </div>
</div>





<script src="{{ asset('chart.js/chart.js') }}"></script>

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
         backgroundColor:[      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 25, 86)',],
      barPercentage: 0.4,
         label: 'Total des coutes par perimetre',
     }],
 }
});
var ctx = document.getElementById('myChartD');
var labels =  {{ Js::from($data['perimetre']) }};
var coute =  {{ Js::from($data['coute'])}};
var myChartD = new Chart(ctx,{
 type:"doughnut",
 data:{
     labels:labels,
     datasets:[{
         data:coute,
         backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 25, 86)',
    ],
    hoverOffset:20,
         label: 'Total des coutes par perimetre',
     }],
 }
});

</script>
@endsection