@extends('layouts.layout')

@auth
<script>window.location.href="/"</script>
@endauth


@section('title')
	Регистрация
@endsection
@section('caption')
<h2>Регистрация</h2>

@endsection

@section('content')
	

@endsection

@section('regform')
<div style="align-content: center; width: 100%; padding-top: 10px">
<h5>Регистрация</h5>	
<form action="{{route('reg-form')}}" method="post" name="reg-form">
	@csrf
            <div class="form-group" >
                <label  for="name">Имя пользователя:</label>
                <input  type="text" class="form-control" id="name" name="name" placeholder="Имя пользователя" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" placeholder="Пароль" name="password" required>
            </div>
	        <div class="form-group">
                <label for="confirmpassword">Подтвердите пароль:</label>
                <input type="password" class="form-control" id="confirmpassword" placeholder="Повторите пароль" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <label for="email">Электронная почта:</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
            </div>
	<hr>
            <button type="submit" class="btn btn-primary  py-2" style="background-color: purple; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#a64ca6'"
        onmouseout="this.style.backgroundColor='purple'" >Зарегистрироваться</button>
        </form>
 </div>



 @endsection 