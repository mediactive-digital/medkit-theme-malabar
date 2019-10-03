<header class="sticky-top">
		<nav class="navbar navbar-expand-md bg-primary navbar-dark p-0">
			<div class="container-fluid p-0">
			
			
				<a class="navbar-brand m-2" href="#">
					<h3 class="text-uppercase ml-5">Logo Client </h3>
				</a>
				
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

	
		
				<div id="navbarTop" class="collapse navbar-collapse justify-content-end">
					<ul class="navbar-nav text-white top-info">
						<li class="nav-item p-5 align-self-center d-block  d-lg-block">
							<h6 class="text-uppercase text-center m-0"> Nom du Salon : <span id="time"></span></h6>
						  </li>
						  
						  
						<li class="nav-item p-lg-5 align-self-center border-left  d-block d-md-none d-lg-block">

							
							<h6 class="text-uppercase text-center m-0">Besoin d'aide</h6><a href="#" class="link-white" target="_blank">Mode d'emploi</a>
						</li>
						
						<li class="nav-item p-4 align-self-center text-center text-md-left">
							<p class="my-0">
								Numéro téléphone
							</p><br>
						</li>
						
						
						<li id="topnav-user" class="nav-item bg-dark p-4">
							<ul class="list-unstyled align-self-center">
								<li class="mb-4 small">
									Raison Sociale
								</li>
								<li class="text-uppercase small">
									<a href="{{ route('logout') }}" class="disconnect text-white">
										<i class="fa fa-fw fa-sign-out"></i> {{ _i('Déconnexion') }}
									</a>
								</li>
							</ul>
						</li>
						
						
						<li id="topnav-lang" class="nav-item border-left">
							<ul class="list-unstyled align-self-center">
								<li class=" text-uppercase small border-bottom p-4 active"><a href="#" class="text-white lang-fr">fr</a></li>
								<li class=" text-uppercase small p-4 "><a href="#" class="text-white lang-en">en</a></li>
							</ul>
						</li>
						
					</ul>		
				</div>
			</div>
		</nav>
	</header>