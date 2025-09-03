@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth

@section('title'){{$userdata->name}}@endsection

@section('caption')
<h3>{{$userdata->name}}</h3>
<h5>Дневник путешествий пользователя:</h5>
<hr>
@endsection


@section('content')
<div style="height:83vh; overflow-y: auto">
@foreach($myposts as $each)
	
<div class="d-flex justify-content-between alert bg-white b-2 p-2 m-2 h-25" >
	
	
	
	<div>
		<img  class="border rounded p-1" style="width: 200px; height: 19vh; object-fit:cover; border-style:groove" src="{{ asset('storage/'.$each->postimg )}}" alt="изображение поста">
	</div>
	<div style="width: 100%; padding: 5px">
	<div style="height: 13vh">
		<a href="{{route('onepost', $each->id)}}"><h5>{{ $each->caption }}</h5> </a>
	<p>{{ substr($each->content,0, 120)}}
		<br>
		@foreach (explode(' ', $each->tags) as $tag)
  @if (!empty($tag))
    <span class="badge text-dark bg-warning me-1">{{ $tag }}</span>
  @endif
@endforeach
		</p>
		</div>	
		 @if($each->perm=='public')
		
		<p align="right"><em>Автор: {{ $each->name }} <br>{{ $each->created_at }} <b style="color:darkgreen">всем</b></em></p>
		@else
		<p align="right"><em>Автор: {{ $each->name }} <br>{{ $each->created_at }} <b style="color:crimson">по подписке</b></em></p>
		@endif
	</div>	
	
</div>
	

@endforeach
	
</div>
<div style="height: 20px; margin-top: 2vh; float: right;   height: auto">
	
@include('vendor.pagination.bootstrap-4', ['paginator'=>$myposts])
		
	</div>
@endsection