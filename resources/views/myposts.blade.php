@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth

@section('title')Мои посты@endsection

@section('caption')
<h2 style="text-align: center; padding-top:15px">Моя лента</h2>

@endsection

@section('content')
<div>
	
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
                    </em>
                </p>
            </div>
        </div>

@endforeach
		</div>
		</diV>
	
</div>
<div style="height: 20px; margin-top: 2vh; float: right;   height: auto">
	
@include('vendor.pagination.bootstrap-4', ['paginator'=>$data])
		
	</div>
@endsection