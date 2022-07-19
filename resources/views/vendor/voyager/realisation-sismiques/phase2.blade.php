@extends('voyager::master')

@section('content')



<ul class="list-group">
    @foreach ($contrat as $item)
	<li class="list-group-item">
		<span class="badge">{{$item->id}}</span>
       <a href="{{ route('phase2.detaille',['id'=>$item->id]) }}">les Objectifs  des realisations de la premier phase du  contrat N° </a> 
	</li>
@endforeach
</ul>
{{-- @foreach ($contrat as $item)
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
			<h5 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$item->id}}" aria-expanded="false" aria-controls="{{$item->id}}" class="collapsed">
                    les Objectifs des realisations Sismique de la premier phase du  contrat numero  {{$item->id}} 
				</a>
			</h5>
		</div>
		<div id="{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
			<div class="panel-body">
				
			</div>
		</div>
	</div>
</div>	
@endforeach --}}
@endsection