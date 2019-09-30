{{-- <nav class="sidebar">
	<div class="logo d-block">
		<a href="{{ route('back.index')}}" class="d-block text-center border-bottom {{ $user->theme ? 'text-white text-uppercase' : 'text-dark text-uppercase' }}">
			{{ env('APP_NAME') }}
		</a>
	</div>
	
</nav> --}}

<nav id="sidebar-left">

		<div class="sticky-top">
			<button id="sidebar-leftCollapse" type="button" data-toggle="collapse" aria-expanded="false" class="btn btn-info navbar-btn d-sm-block">
				<span>Menu</span>
			</button>
		</div>
	
		  <div class="sticky-top">
			  <div class="sidebar-header p-4">
			  <img class="img-fluid d-block mx-auto" src="{{ asset('images/malabar.jpg') }}">
				<strong>
					<img class="img-fluid d-block mx-auto" src="{{ asset('images/malabar.jpg') }}">
				</strong>
			</div>
			@php
				// dd(config('laravel-menu.views.back.sidebar'));
			@endphp
			@include(config('laravel-menu.views.back.sidebar'), ['items' => $menu->roots()])
			 {{-- <ul id="menu" class="list-unstyled mt-5">
				<li class=" active"><a href="#" class=""><i class="fa fa-home" aria-hidden="true"></i>Tableau de Bord</a><ul class="collapse list-unstyled "></ul></li>
				<li class=""><a href="#invitationSubmenu" data-toggle="collapse" aria-expanded="true" class=""><i class="fa fa-envelope" aria-hidden="true"></i>Vos Pass Invités</a><ul class="collapse list-unstyled show" id="invitationSubmenu"><li class=" "><a href="#" class=""><i class="fa fa-long-arrow-right" aria-hidden="true"></i>E-invitations BtoB</a><ul class="collapse list-unstyled " id="0Submenu"></ul></li><li class=" "><a href="#" class=""><i class="fa fa-long-arrow-right" aria-hidden="true"></i>E-Invitations Samedi</a><ul class="collapse list-unstyled " id="1Submenu"></ul></li></ul></li>
			</ul> --}}
		</div>
	
	</nav>