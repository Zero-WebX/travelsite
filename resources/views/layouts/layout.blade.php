<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>	
<meta charset="utf-8">
<title>@yield('title')</title>
<!-- Bootstrap CSS (jsDelivr CDN) -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	
	 <link rel="stylesheet" href="{{ asset('/fonts/font-awesome.min.css')}}">
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>	
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54" style="background-color:#F4F4F4">
    @include('includes.SideMenu1')

@if(request()->is('myprofile'))
   <div class="position-absolute z-2 pt-5" style="width:100%">
	<header class="masthead position-relative" style="height: 230px; overflow: hidden;">
    <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover" style="top: 0; left: 0; z-index: 0; ">
        <source src="{{ asset('icons/backround/background2.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <div class="container position-relative" style="padding-top: 30px; z-index: 1;">
        <div class="intro-text text-white">
            <div class="intro-lead-in"><span><h4>Добро пожаловать!</h4></span></div>
            <div class="intro-heading text-uppercase"><span>Приложение для блога</span></div>
        </div>
    </div>
</header>
	</div>
	@elseif(request()->is('user*'))
	<div class="position-absolute z-2 pt-5" style="width:100%">
	<header class="masthead position-relative" style="height: 230px; overflow: hidden;">
    <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover" style="top: 0; left: 0; z-index: 0; ">
        <source src="{{ asset('icons/backround/background2.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <div class="container position-relative" style="padding-top: 30px; z-index: 1;">
        <div class="intro-text text-white">
            <div class="intro-lead-in"><span><h4>Добро пожаловать!</h4></span></div>
            <div class="intro-heading text-uppercase"><span>Приложение для блога</span></div>
        </div>
    </div>
</header>
	</div>
	 @else

<div class="pt-5" style="width:100%">
	<header class="masthead position-relative" style="height: 230px; overflow: hidden;">
    <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover" style="top: 0; left: 0; z-index: 0; ">
        <source src="{{ asset('icons/backround/background2.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <div class="container position-relative" style="padding-top: 30px; z-index: 1;">
        <div class="intro-text text-white">
            <div class="intro-lead-in"><span><h4>Добро пожаловать!</h4></span></div>
            <div class="intro-heading text-uppercase"><span>Дневник путешествий</span></div>
        </div>
    </div>
</header>
	</div>



	  @endif
   
  @yield('caption') 

	
	
	 
	<div class="position-relative p-2 text-left" style="background-color:#F4F4F4; height: 90vh" style="align-items: center" >
		
		@include('includes.servicesMessages') 
		
		
		
		
		@yield('content')
		
		
		
		@if(request()->is('registration'))
		@yield('regform')
		@endif
		
		@if(request()->is('newpublication'))
		@yield('newpubform')
		@endif
		
		@yield('modifyform')
		
		@if(request()->is('login'))
		@yield('loginform')
		@endif
		
		</div>
    
    
    
    
    
    
    
    @yield('scripts')     
   
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>

</html>