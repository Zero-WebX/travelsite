@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth

@section('title')Входящие запросы@endsection

@section('caption')


@endsection

@section('content')


<div>
	
	<div style="padding-left: 15px">
	<button type="button"
        class="btn btn-link text-decoration-none p-0 border-0 bg-transparent d-flex align-items-center"
        data-bs-toggle="collapse"
        data-bs-target="#collapseContent"
        aria-expanded="false"
        aria-controls="collapseContent"
        onclick="this.querySelector('.arrow').textContent = this.getAttribute('aria-expanded') === 'true' ? '🔻' : '🔺'">
		 <span class="arrow">🔻</span>
  <span class="me-2">Входящие запросы</span>
 
</button>
		
		
	</div>
	
	
	
	
	
	
	<div  class="collapse show mt-2" id="collapseContent">
	
	
	
	@foreach($data as $each)
	
	<div class="alert alert-light d-flex justify-content-between align-items-center border shadow-sm p-3 mb-3">
  <!-- Левая часть: текст -->
  <div>
    <h5 class="mb-1">Новый запрос от пользователя</h5>
    <p class="mb-0 text-muted">Пользователь: {{ $each->name }} <br>{{ $each->created_at }}</p>
  </div>

  <!-- Правая часть: кнопки -->
  <div class="ms-3 d-flex gap-2 ">
	  
	  <form action="{{route('requesttouser-ack')}}" method="post" name="requesttouser-ack">
        @csrf
		<input type="hidden" name="senderid" value="{{$each->senderid}}">
		<input type="hidden" name="requestid" value="{{$each->id}}">
        <button type="submit"
                class="btn btn-success ">
                
            Принять 
        </button>
    </form>
	  
	  
	 
	  
	  <form action="{{route('requesttouser-reject')}}" method="post" name="requesttouser-reject">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$each->senderid}}">
		<input type="hidden" name="requestid" value="{{$each->id}}"> 
        <button type="submit"
                class="btn btn-outline-danger">
                
            Отклонить 
        </button>
    </form>
	  
   
   
  </div>
</div>
	
	@endforeach
	

		
		
		
		

	</div>
	
	<div style="padding-left: 15px">
	<button type="button"
        class="btn btn-link text-decoration-none p-0 border-0 bg-transparent d-flex align-items-center"
        data-bs-toggle="collapse"
        data-bs-target="#collapseContentOut"
        aria-expanded="false"
        aria-controls="collapseContentOut"
        onclick="this.querySelector('.arrow').textContent = this.getAttribute('aria-expanded') === 'true' ? '🔻' : '🔺'">
	 <span class="arrow">🔻</span>	
  <span class="me-2">Исходящие запросы</span>
 
</button>
		
		
	</div>
	
<div  class="collapse show mt-2" id="collapseContentOut">
@foreach($dataout as $each)
	
	
	
	<div class="alert alert-light d-flex justify-content-between align-items-center border shadow-sm p-3 mb-3">
  <!-- Левая часть: текст -->
  <div>
    <h5 class="mb-1">Запрос пользователю</h5>
    <p class="mb-0 text-muted">Пользователь: {{ $each->name }} <br>{{ $each->created_at }}</p>
  </div>

  <!-- Правая часть: кнопки -->
  <div class="ms-3 d-flex gap-2 ">
	  
	  
	  
	  
	 
	  
	  <form action="" method="post" name="requesttouser-form">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$each->senderid}}">
		<input type="hidden" name="requestid" value="{{$each->id}}"> 
        <button type="submit"
                class="btn btn-outline-danger">
                
           Отменить 
        </button>
    </form>
	  
   
   
  </div>
</div>
	
	@endforeach		
	
	</div>
	
	
	<div style="padding-left: 15px">
	<button type="button"
        class="btn btn-link text-decoration-none p-0 border-0 bg-transparent d-flex align-items-center"
        data-bs-toggle="collapse"
        data-bs-target="#collapseContentCanceled"
        aria-expanded="false"
        aria-controls="collapseContentOut"
        onclick="this.querySelector('.arrow').textContent = this.getAttribute('aria-expanded') === 'true' ? '🔻' : '🔺'">
	 <span class="arrow">🔻</span>	
  <span class="me-2">Отклоненные входящие запросы</span>
 
</button>
		
		
	</div>
	
	<div  class="collapse show mt-2" id="collapseContentCanceled">
@foreach($datacanceledrequests as $each)
	
	
	
	<div class="alert alert-light d-flex justify-content-between align-items-center border shadow-sm p-3 mb-3">
  <!-- Левая часть: текст -->
  <div>
    <h5 class="mb-1">Отклоненный запрос от пользователя</h5>
    <p class="mb-0 text-muted">Пользователь: {{ $each->name }} <br>{{ $each->created_at }}</p>
  </div>

  <!-- Правая часть: кнопки -->
  <div class="ms-3 d-flex gap-2 ">
	  
	  
	  
	  
	 
	  
	  <form action="" method="post" name="requesttouser-form">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$each->senderid}}">
		<input type="hidden" name="requestid" value="{{$each->id}}"> 
        <button type="submit"
                class="btn btn-outline-danger">
                
           Отменить 
        </button>
    </form>
	  
   
   
  </div>
</div>
	
	@endforeach		
	
	</div>
	
	
	
	
</div>	
@endsection