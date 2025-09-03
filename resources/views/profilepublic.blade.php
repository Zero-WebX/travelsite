@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth

@section('title'){{$userdata->name}}@endsection

@section('caption')

<div class="d-flex justify-content-center align-items-center p-3 position-relative" style="cover; z-index: 3; margin-top: 150px;">

      <img src="{{asset('storage/'.$userdata->img )}}" alt="Аватар пользователя"
           class="rounded-circle img-fluid mb-3"
           style="width: 250px; height: 250px; object-fit: cover;">






</div>




<div style="padding-top: 5px; padding-left: 5px; "><h3 align="center">{{$userdata->name}}</h3></div>
<div>
  <p align="center"><em>
     {{ $userdata->aboutme }}
  </em></p>
</div>


<hr>
<div class="d-flex justify-content-center gap-3" style="padding-top: 10px; padding-left: 5px; padding-bottom: 5px ">
	
	
    <form action="{{route('subscribe-form')}}" method="post" name="subscribe-form">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$userdata->id}}">
        <button {{$subscribed}} type="submit" 
                class="btn btn-primary py-2"
                style="background-color: #6f42c1; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
                onmouseover="this.style.backgroundColor='#a64ca6'"
                onmouseout="this.style.backgroundColor='#6f42c1'">
            Подписаться
        </button>
    </form>

    <form action="{{route('unsubscribe-form')}}" method="post" name="unsubscribe-form">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$userdata->id}}">
        <button {{$unsubscribe}} type="submit"
                class="btn btn-primary py-2"
                style="background-color: #6f42c1; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
                onmouseover="this.style.backgroundColor='#a64ca6'"
                onmouseout="this.style.backgroundColor='#6f42c1'">
            Отписаться
        </button>
    </form>
	<form action={{route('requesttouser-form')}} method="post" name="requesttouser-form">
        @csrf
		<input type="hidden" name="subscriber_id" value="{{$userdata->id}}">
        <button {{$requestsend}} type="submit"
                class="btn btn-primary py-2"
                style="background-color: #6f42c1; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
                onmouseover="this.style.backgroundColor='#a64ca6'"
                onmouseout="this.style.backgroundColor='#6f42c1'">
            Запрос 
        </button>
    </form>
	
</div>
<h5 align="center">Посты пользователя:</h5>

@endsection


@section('content')
<div class="container">
    <div class="row" id="postContainer">
@foreach($data as $each)
	
<div class="col-md-4 mb-4">
            <div class="post-block alert bg-white p-3 rounded shadow-sm h-100">

                {{-- Миниатюра изображения --}}
                @if(!empty($each->postimg))
                <div class="mb-2 text-center">
                    <img class="border rounded"
                         style="width: 100%; max-height: 200px; object-fit: cover; border-style: groove;"
                         src="{{ asset('storage/' . $each->postimg) }}"
                         alt="изображение поста">
                </div>
                @endif

                {{-- Заголовок --}}
                <h5>
                    <a href="{{ route('onepost', $each->id) }}" class="text-decoration-none text-dark">
                        {{ $each->caption }}
                    </a>
                </h5>

                {{-- Краткое содержание --}}
                <p>{{ \Illuminate\Support\Str::limit($each->content, 50) }}</p>

                {{-- Теги --}}
                <p>
                    @foreach (explode(' ', $each->tags) as $tag)
                        @if (!empty($tag))
                            <span class="badge bg-warning text-dark me-1">{{ $tag }}</span>
                        @endif
                    @endforeach
                </p>

                {{-- Автор --}}
                <p class="text-end mb-0">
                    <em>
                        <a href="{{ route('profilepublic', $each->userid) }}" class="text-muted text-decoration-none">
                            Автор: {{ $each->name }}
                        </a> | {{ $each->created_at }} 
						@if($each->perm=='public')
		
		<p align="right"><b style="color:darkgreen">всем</b></p>
		@else
		<p align="right">по запросу</b></p>
		@endif
                    </em>
                </p>
            </div>
        </div>

@endforeach
		</div>
		</diV>

<div style="height: 20px; margin-top: 2vh; float: right;   height: auto">
	
@include('vendor.pagination.bootstrap-4', ['paginator'=>$data])
		
	</div>
@endsection