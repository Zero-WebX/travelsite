@extends('layouts.layout')

@section('title')
    {{ $data->caption }}
@endsection

@section('caption')
    <div class="py-3 px-4 border-bottom">
        <h2 class="fw-bold">{{ $data->caption }}</h2>
    </div>
@endsection

@section('content')

{{-- Фото + Карта в одной карточке --}}
@if(!empty($data->latitude) && !empty($data->longitude) && !empty($data->postimg))
<div class="container-fluid mb-5 px-3">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-body-tertiary d-flex justify-content-between align-items-center px-3 py-2">
            <h5 class="mb-0">📍 Местоположение и изображение</h5>
            <a href="https://yandex.ru/maps/?ll={{ $data->longitude }},{{ $data->latitude }}&z=16"
               target="_blank"
               class="btn btn-sm btn-outline-primary rounded-pill">
               🔗 Открыть в Яндекс.Картах
            </a>
        </div>
        <div class="card-body px-3 py-3">
            <div class="row gx-2 gy-2">
                <div class="col-lg-5 col-md-6">
                    <div class="overflow-hidden rounded shadow-sm" style="height: 100%; max-height: 400px;">
                        <img src="{{ asset('storage/' . $data->postimg) }}"
                             alt="изображение поста"
                             class="img-fluid w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="rounded shadow-sm overflow-hidden" style="height: 100%; max-height: 400px;">
                        <div id="map" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container py-4">

    {{-- Теги --}}
    <div class="mb-3">
        @foreach (explode(' ', $data->tags) as $tag)
            @if (!empty($tag))
                <span class="badge bg-warning text-dark me-1">{{ $tag }}</span>
            @endif
        @endforeach
    </div>

    {{-- Кнопки редактирования --}}
    @if(auth()->id() == $data->userid)
    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('postmodify', $data->id) }}" class="btn btn-outline-warning rounded-pill">
            ✏️ Редактировать
        </a>
        <a href="{{ route('postdelete', $data->id) }}" class="btn btn-outline-danger rounded-pill">
            🗑️ Удалить
        </a>
    </div>
    @endif

    {{-- Контент поста --}}
    <div class="mb-5">
        <p class="fs-5">{{ $data->content }}</p>
    </div>

<div class="py-3 px-4 border-bottom">
        <h4 class="fw-bold" style="color:darkred;">Цена: {{ $data->cost }}</h4>
    </div>


<!--место для слайдера-->
 <div class="py-3 px-4 border-bottom">
        <h3 class="fw-bold">Изображение мест</h3>
    </div>

@if($slider->count())
<div id="postSlider" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">

       @foreach($slider as $index => $each)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <button type="button"
                    class="border-0 p-0 bg-transparent w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#slideModal"
                    data-slide="{{ asset('storage/' . $each->slide) }}"
                    data-description="{{ $each->description }}">
                <img src="{{ asset('storage/' . $each->slide) }}"
                     class="d-block w-100 rounded shadow-sm"
                     alt="слайд {{ $index + 1 }}"
                     style="max-height: 400px; object-fit: cover;">
            </button>
            <div class="carousel-caption d-md-block bg-dark bg-opacity-50 rounded px-3 py-2">
                <p class="mb-0">{{ $each->description }}</p>
            </div>
        </div>
        @endforeach

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#postSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Назад</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#postSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Вперёд</span>
    </button>

    <div class="carousel-indicators">
        @foreach($slider as $index => $each)
        <button type="button"
                data-bs-target="#postSlider"
                data-bs-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}"
                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                aria-label="Слайд {{ $index + 1 }}"></button>
        @endforeach
    </div>
</div>
@endif


    {{-- Комментарии --}}
    <div class="mb-4">
        <h5 class="mb-3">💬 Комментарии</h5>

        @auth
        <div class="text-end mb-3">
            <a href="#comment-form" class="btn btn-sm text-white"
               style="background-color: #6f42c1; transition: background-color 0.3s;"
               data-bs-toggle="modal"
               data-bs-target="#commentModal"
               onmouseover="this.style.backgroundColor='#8540d4'"
               onmouseout="this.style.backgroundColor='#6f42c1'">
               ➕ Добавить комментарий
            </a>
        </div>
        @endauth

        @forelse($comments as $each)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">{{ $each->name }}</h6>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($each->comment, 120) }}</p>
                <div class="text-end">
                    <small class="text-muted">{{ $each->updated_at }}</small>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Комментариев пока нет.</p>
        @endforelse
    </div>

    {{-- Модальное окно добавления комментария --}}
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h5 class="modal-title">Добавить комментарий</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('newcomment-form') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $data->id }}">
                        <div class="mb-3">
                            <label for="content" class="form-label">Комментарий</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<!--- Модальное окно слайдера --->
<div class="modal fade" id="slideModal" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="slideModalLabel">Просмотр слайда</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalSlideImage" src="" class="img-fluid rounded mb-3" alt="слайд" style="max-height: 80vh;">
                <p id="modalSlideDescription" class="text-muted"></p>
            </div>
        </div>
    </div>
</div>




@endsection

{{-- Скрипт Яндекс.Карт --}}
@if(!empty($data->latitude) && !empty($data->longitude))
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script>
ymaps.ready(function () {
    const map = new ymaps.Map("map", {
        center: [{{ $data->latitude }}, {{ $data->longitude }}],
        zoom: 15,
        controls: ['zoomControl', 'fullscreenControl']
    });

    const placemark = new ymaps.Placemark(
        [{{ $data->latitude }}, {{ $data->longitude }}],
        {
            balloonContentHeader: "<strong>{{ $data->caption }}</strong>",
            balloonContentBody: "{{ \Illuminate\Support\Str::limit($data->content, 100) }}",
            hintContent: "Точка поста"
        },
        {
            preset: 'islands#icon',
            iconColor: '#ff6600'
        }
    );

    map.geoObjects.add(placemark);
});
</script>

{{-- Скрипт Модального окна --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slideModal = document.getElementById('slideModal');
    slideModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageSrc = button.getAttribute('data-slide');
        const description = button.getAttribute('data-description');

        document.getElementById('modalSlideImage').src = imageSrc;
        document.getElementById('modalSlideDescription').textContent = description;
    });
});
</script>


@endif