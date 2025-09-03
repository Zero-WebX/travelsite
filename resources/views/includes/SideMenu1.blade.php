@section('SideMenu')

<nav class="navbar navbar-expand-lg fixed-top  navbar-dark" id="mainNav" style="background-color: rebeccapurple">
        <div class="container">
		<a class="navbar-brand" href="#page-top"><img src ="{{asset('icons/logozero.png')}}" height = 50px></img>
		
		</a>
		<a class="navbar-brand" href="#page-top">
		
	
		
		</a>
		<button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
			
                <ul class="navbar-nav ms-auto text-uppercase">
				<li class="nav-item"><a class="nav-link" href="/myprofile">
			@auth
		
   🙎{{ Auth::user()->name }}!

		   @else 
		  
		   @endauth
		  </a> </li>
                    <li class="nav-item "><a class="nav-link" href="/">🏡Главная</a></li>
                   @auth 
					@else<li class="nav-item"><a class="nav-link" href="/registration">Регистрация</a></li>@endauth
					@auth 
                    @else<li class="nav-item"><a class="nav-link" href="/login">Вход</a></li>@endauth
                    <li class="nav-item"><a class="nav-link" href="/travels">🏖️Путешествия</a></li>
                    @auth<li class="nav-item"><a class="nav-link" href="/newpublication">🖊️ Новая запись</a></li>@endauth
					

					<!--<li class="nav-item"><a class="nav-link" href="/users">Пользователи</a></li>-->

					@auth
					
					
					<li class="nav-item"><a class="nav-link" href="{{'logout'}}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Выход</a></li>@endauth
                </ul>
            </div>
        </div>
	<form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">@csrf</form>
    </nav>
