@section('SideMenu')

<div class="d-flex flex-column flex-shrink-0 p-3 " style="width:280px; height:100vh;background-color:#6f42c1;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Меню сайта</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
		  
		  @if(request()->is('/'))
	    <a href="/" class="btn btn-warning rounded-pill " aria-current="page">
		 @else 
		  <a href="/" class="nav-link text-white">
	   @endif
      
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/"></use></svg>
          Главная
        </a>
      </li>
		  
		   @auth
		   @else
		   
		  <li>
       @if(request()->is('registration'))
	   <a href="/registration"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/registration" class="nav-link text-white">
	   @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/registration"></use></svg>
        Регистрация
        </a>
		  
		  </li>
		  
		 @endauth
			  
		 @auth
		   @else
		   
		  <li>
       @if(request()->is('login'))
	   <a href="/login"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/login" class="nav-link text-white">
	   @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/login"></use></svg>
        Вход
        </a>
		  
		  </li>
		  
		 @endauth	  
			  
			  
      <li>
		  
		   @if(request()->is('posts'))
	   <a href="/posts"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/posts" class="nav-link text-white">
	     @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/posts"></use></svg>
           Посты пользователей
        </a>
      </li>
		  
		  @auth
		   <li>
			   
		  @if(request()->is('newpublication'))
	   <a href="/newpublication"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/newpublication" class="nav-link text-white">
	   @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/newpublication"></use></svg>
         Новый пост
        </a>
      </li>
		 @else
		 @endauth	   
		  
		  
		 @auth 
      <li>
		  @if(request()->is('myposts'))
	   <a href="/myposts"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/myposts" class="nav-link text-white">
	   @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/myposts"></use></svg>
         Мои посты
        </a>
      </li>
		  @else
		  @endauth
      <li>
		  
		    @if(request()->is('users'))
	   <a href="/users"  class="btn btn-warning rounded-pill ">
		 @else 
		  <a href="/users" class="nav-link text-white">
	     @endif
       
          <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="/users"></use></svg>
          Пользователи
        </a>
      </li>
    </ul>
    <hr>
	 @auth
    <div class="dropdown">
      
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
       
		   @auth
		  <strong> <a href="/myprofile" class="text-white text-decoration-none">
    {{ Auth::user()->name }}
</a></strong>
		   @else 
		   <strong>Гость</strong>
		   @endauth
		 
		  
		 
      
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#">Новый пост</a></li>
        <li><a class="dropdown-item" href="#">Настройки</a></li>
        <li><a class="dropdown-item" href="#">Мой профиль</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{'logout'}}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти из профиля</a></li>
      </ul>
		<form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">@csrf</form>
    </div>
	@else 
	@endauth	
      
  </div>
