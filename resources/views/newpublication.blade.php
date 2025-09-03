@extends('layouts.layout')

@auth
@else
<script>window.location.href="/login"</script>
@endauth


@section('title')
	Новый пост
@endsection
@section('caption')


@endsection

@section('content')
	

@endsection

@section('newpubform')
<div style="align-content: center; width: 100%; padding-top: 10px">
	<h5>Новая запись о путешествии</h5>
<form action="{{route('newpub-form')}}" method="post" name="newpub-form" enctype="multipart/form-data">
	@csrf
            <div class="form-group" >
                <label  for="caption">Заголовок :</label>
                <input  type="text" class="form-control" id="caption" name="caption" placeholder="Заголовок путешествия" required>
            </div>
	
	       <div class="form-group" >
                <label  for="postimg">Изображение к записи:</label>
                <input  type="file" class="form-control" id="postimg" name="postimg" accept="image/*">
            </div>
	      
	    <div class="form-group" >
                <label  for="tags">Теги:(вводить через пробел)</label>
                <input  type="text" class="form-control" id="tags" name="tags" placeholder="коучинг программирование отдых" >
            </div>
	
            
            <div class="form-group">
                <label for="content">Содержание:</label>
                <textarea type="text" class="form-control" id="content" rows="5" placeholder="Введите текст" name="content" required></textarea>
            </div>

            <div class="form-group">
    <label>Слайды путешествия:</label>
    <div id="slides-container"></div>
    <button type="button" class="btn btn-secondary mt-2" onclick="addSlide()">Добавить слайд</button>
</div>

<div class="form-group">
    <label for="map">Выберите местоположение:</label>
    <div id="map" style="width: 100%; height: 400px; margin-bottom: 10px;"></div>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</div>

	  <div class="form-group" >
                <label  for="cost">Цена путешествия :</label>
                <input  type="text" class="form-control" id="cost" name="cost" placeholder="Пример 1000-2000 USD" required>
            </div>

	
	
	<hr>
	<button type="submit" class="btn btn-primary  py-2" style="background-color: purple; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#a64ca6'"
        onmouseout="this.style.backgroundColor='purple'" >Опубликовать</button>

        </form>
 </div>




<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script>
ymaps.ready(function () {
    var map = new ymaps.Map("map", {
        center: [37.9559, 58.3838], // Ашхабад
        zoom: 12
    });

    var placemark;

    map.events.add('click', function (e) {
        var coords = e.get('coords');

        if (placemark) {
            placemark.geometry.setCoordinates(coords);
        } else {
            placemark = new ymaps.Placemark(coords, {}, { draggable: true });
            map.geoObjects.add(placemark);
        }

        document.getElementById('latitude').value = coords[0];
        document.getElementById('longitude').value = coords[1];
    });
});
</script>
<script>
let slideCounter = 0;

function addSlide() {
    const container = document.getElementById('slides-container');
    const slideId = `slide-${slideCounter++}`;

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
	
 @endsection 