@extends('layouts.layout')
@auth
<script>window.location.href="/"</script>
@endauth
@section('title')
	Вход
@endsection
@section('content')
	<h2>Вход</h2>
@endsection

@section('loginform')

<div style="align-content: center; width: 100%; padding-top: 10px">
    <h5>Вход</h5>	
<form action="{{ route('log-form') }}" method="post" name="log-form">
	@csrf
            <div class="form-group">
                <label for="email">Электронная почта:</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
            </div>
	
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" placeholder="Пароль" name="password" required>
            </div>
	        <div class="form-group">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
                </label>
            </div>
            
	<hr>
            <button type="submit" class="btn btn-primary  py-2" style="background-color: purple; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#a64ca6'"
        onmouseout="this.style.backgroundColor='purple'" >Войти</button>
        </form>
 </div>



 @endsection 