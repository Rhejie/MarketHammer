<?php
	$languages = config('app.languages');
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

        @if(Auth::user()->userType->code === 'buyer')
	        <a class="navbar-brand" href="{{ url('/buyer') }}">

		    <!-- <span class="logo-mini">M<span class="brand-orange">H</span></span>
		    <span class="logo-lg">Market <span class="brand-orange">Hammer</span></span> -->

		    <span class="logo-mini"><img style="width: 30%;" src="/image/mh-logo-icon.png"></span>

            <span class="logo-lg"><img style="width: 100%;" src="/image/mh_buyer_logo.png"></span>
		@elseif(Auth::user()->userType->code === 'supplier')
			<a class="navbar-brand" href="{{ url('/supplier') }}">

			<span class="logo-mini"><img style="width: 30%;" src="/image/mh-logo-icon.png"></span>
			<span class="logo-lg"><img style="width: 100%;" src="/image/mh-main-logo.png"></span>
        @else
	        <a class="navbar-brand" href="{{ url('/') }}">

		<!-- <span class="logo-mini">M<span class="brand-orange">H</span></span>
		<span class="logo-lg">Market <span class="brand-orange">Hammer</span></span> -->

		    <span class="logo-mini"><img style="width: 30%;" src="/image/mh-logo-icon.png"></span>
            <span class="logo-lg"><img style="width: 100%;" src="/image/mh-main-logo.png"></span>
        @endif
	</a>
	<!-- Left navbar links -->
	<ul class="navbar-nav menu">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<!-- <li class="nav-item d-none d-sm-inline-block">
			<a href="../index3.html" class="nav-link">Home</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="#" class="nav-link">Contact</a>
		</li> -->
	</ul>

	<!-- SEARCH FORM -->
	<!-- <form class="form-inline ml-3">
		<div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
	</form> -->

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item d-flex align-items-center">
           <language-switcher
	           :languages="{{ json_encode($languages) }}">
           </language-switcher>
        </li>
		<!-- Messages Dropdown Menu -->
		<!-- <li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-comments"></i>
				<span class="badge badge-danger navbar-badge">3</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<div class="media">
						<img src="../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								Brad Diesel
								<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">Call me whenever you can...</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<div class="media">
						<img src="../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								John Pierce
								<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">I got your message bro</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<div class="media">
						<img src="../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								Nora Silvester
								<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">The subject goes here</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
			</div>
		</li> -->
		<!-- Notifications Dropdown Menu -->
		<!-- <li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">15 Notifications</span>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="float-right text-muted text-sm">3 mins</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-users mr-2"></i> 8 friend requests
					<span class="float-right text-muted text-sm">12 hours</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> 3 new reports
					<span class="float-right text-muted text-sm">2 days</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<i class="fas fa-th-large"></i>
			</a>
		</li> -->
        @if(Auth::user()->userType->code === 'buyer')
        <li class="nav-item d-flex align-items-center">
            <li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="fas fa-bell" style="margin-right: 20px"></i>
					<span class="badge badge-warning navbar-badge">15</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-item dropdown-header">15 Notifications</span>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-envelope mr-2"></i> 4 new messages
						<span class="float-right text-muted text-sm"></span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-users mr-2"></i> 8 friend requests
						<span class="float-right text-muted text-sm"><small>3 mins</small></span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-file mr-2"></i> 3 new reports
						<span class="float-right text-muted text-sm"><small>3 mins</small></span>
					</a>
					<div class="dropdown-divider"></div>
				</div>
			</li>
        </li>
        {{--  <li class="nav-item  d-flex align-items-center dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a  class="dropdown-item"  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
        @else
            <li class="nav-item">
	            <a  class="nav-link"  href="{{ route('logout') }}"
	                onclick="event.preventDefault();
	                                document.getElementById('logout-form').submit();">
	                {{ __('Logout') }}
	            </a>
	            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	                @csrf
	            </form>
            </li> --}}
        @endif
		<li class="nav-item  d-flex align-items-center dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
			</a>
			<div class="dropdown-menu logout" aria-labelledby="navbarDropdown">
				<a  class="dropdown-item"  href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST">
					@csrf
				</form>
			</div>
		</li>
	</ul>
</nav>
<!-- /.navbar -->
