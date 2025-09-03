@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth


@section('title')
	Редактирование поста
@endsection
@section('caption')
<h2>Редактирование поста</h2>

@endsection

@section('content')
	

@endsection

@section('modifyform')
<div style="align-content: center; width: 100%; padding-top: 10px">
<form action="{{route('modifypub-form')}}" method="post" name="modifypub-form" enctype="multipart/form-data">
	@csrf
    <input type="hidden" name="post_id" value="{{ $data->id }}">

    <div class="form-group">
        <label for="caption">Заголовок поста:</label>
        <input type="text" class="form-control" id="caption" name="caption" value="{{ $data->caption }}" required>
    </div>

    <div class="form-group">
        <label for="postimg">Изображение к посту:</label>
        <input type="file" class="form-control" id="postimg" name="postimg" accept="image/*">
    </div>

    <div class="form-group">
        <label for="tags">Теги:</label>
        <input type="text" class="form-control" id="tags" name="tags" value="{{ $data->tags }}">
    </div>

    <div class="d-flex justify-content-between alert bg-white p-2 m-2">
        <img class="border rounded p-1" style="width: 100%; height: 25vh; object-fit:contain; border-style:groove"
             src="{{ asset('storage/'.$data->postimg) }}" alt="изображение поста" id="preview">
    </div>

    <div class="form-group">
        <label for="content">Содержание:</label>
        <textarea class="form-control" id="content" rows="5" name="content" required>{{ $data->content }}</textarea>
    </div>

    <div class="form-group">
        <label>Слайды путешествия:</label>
        <div id="slides-container">
            @foreach($slider as $index => $each)
            <div class="slide-item mb-3" id="existing-slide-{{ $index }}">
                <img src="{{ asset('storage/' . $each->slide) }}" class="img-fluid rounded mb-2" style="max-height: 200px;">
                <input type="text" name="existing_descriptions[]" class="form-control mb-1" value="{{ $each->description }}" maxlength="120">
                <input type="hidden" name="existing_slide_ids[]" value="{{ $each->id }}">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeSlide('existing-slide-{{ $index }}')">Удалить слайд</button>
                <hr>
            </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary mt-2" onclick="addSlide()">Добавить новый слайд</button>
    </div>

    <div class="form-group">
        <label for="map">Выберите местоположение:</label>
        <div id="map" style="width: 100%; height: 400px; margin-bottom: 10px;"></div>
        <input type="hidden" name="latitude" id="latitude" value="{{ $data->latitude }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ $data->longitude }}">
    </div>

    <div class="form-group">
        <label for="cost">Цена путешествия:</label>
        <input type="text" class="form-control" id="cost" name="cost" value="{{ $data->cost }}" placeholder="Пример: 1000-2000 USD" required>
    </div>

    <hr>
    <button type="submit" class="btn btn-primary py-2" style="background-color:purple;">Сохранить</button>
    <a href="{{ route('postdelete', $data->id) }}" class="btn btn-danger py-2">Удалить</a>
</form>
</div>



<!--Скрипт для подставки временного изображения начало -->
<script>
document.getElementById('postimg').addEventListener("change", function(event) {
	const file = event.target.files[0];// Получаем файл
	
	if (file) {
		const reader = new FileReader();
		reader.onload = function(e){
			document.getElementById("preview").src = e.target.result;//Обновляем изображение
			
		};
		reader.readAsDataURL(file);
	}
});
</script>
<!--Скрипт для подставки временного изображения конец -->

<!--Скрипт для добавления и удаления слайдов -->
<script>
let slideCounter = 0;

function addSlide() {
    const container = document.getElementById('slides-container');
    const slideId = `new-slide-${slideCounter++}`;

    const slideBlock = document.createElement('div');
    slideBlock.className = 'slide-item mb-3';
    slideBlock.id = slideId;

    slideBlock.innerHTML = `
        <input type="file" name="slides[]" accept="image/*" class="form-control mb-1" required>
        <input type="text" name="descriptions[]" maxlength="120" class="form-control mb-1" placeholder="Описание слайда (до 120 символов)" required>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeSlide('${slideId}')">Удалить слайд</button>
        <hr>
    `;

    container.appendChild(slideBlock);
}

function removeSlide(id) {
    const slide = document.getElementById(id);
    if (slide) slide.remove();
}
</script>
<!--Скрипт для добавления и удаления слайдов -->
<!--Яндекс карты -->

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script>
ymaps.ready(function () {
    var map = new ymaps.Map("map", {
        center: [{{ $data->latitude ?? 37.9559 }}, {{ $data->longitude ?? 58.3838 }}],
        zoom: 12
    });

    var placemark = new ymaps.Placemark([{{ $data->latitude ?? 37.9559 }}, {{ $data->longitude ?? 58.3838 }}], {}, { draggable: true });
    map.geoObjects.add(placemark);

    placemark.events.add('dragend', function (e) {
        var coords = placemark.geometry.getCoordinates();
        document.getElementById('latitude').value = coords[0];
        document.getElementById('longitude').value = coords[1];
    });

    map.events.add('click', function (e) {
        var coords = e.get('coords');
        placemark.geometry.setCoordinates(coords);
        document.getElementById('latitude').value = coords[0];
        document.getElementById('longitude').value = coords[1];
    });
});
</script>
 @endsection 