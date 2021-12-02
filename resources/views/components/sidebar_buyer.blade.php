<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div><!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<div class="sidebar">

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="/buyer" class="nav-link {{ Request::path() == 'buyer' ? 'active' : '' }}">
						<i class="nav-icon fas fa-home"></i>
						<p>{{ __('Home') }}</p>
					</a>
				</li>
                <li class="nav-item">
					<a href="/buyer/message" class="nav-link {{ Route::is('buyer.message') ? 'active' : '' }}">
						<i class="nav-icon fas fa-envelope"></i>
						<p> {{ __('Message') }}<!-- <span class="badge badge-danger navbar-badge">3</span> --></p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-archive"></i>
						<p>
							{{ __('Orders') }}
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview {{ Route::is('buyer.buyer-form-template.*') ? 'menu-open' : '' }} {{ Request::path() == 'buyer/form/list' ? 'menu-open' : '' }}">
					<a href="#" class="nav-link">
						<i class="nav-icon fab fa-wpforms"></i>
						<p>
							{{ __('Forms') }}
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/buyer/form/list" class="nav-link {{ Request::path() == 'buyer/form/list' ? 'active' : '' }}">
								<i class="fas fa-list-alt nav-icon"></i>
								<p>{{ __('List') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/buyer/buyer-form-template#/buyer-form-template-list"
								class="nav-link {{ Route::is('buyer.buyer-form-template.*') ? 'active' : '' }}">
								<i class="fas fa-file-alt nav-icon"></i>
								<p>{{ __('Templates') }}</p>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="/buyer/nda" class="nav-link {{ Route::is('buyer.nda.*') ? 'active' : '' }}">
								<i class="fas fa-file-alt nav-icon"></i>
								<p>{{ __('Upload NDA File') }}</p>
							</a>
						</li> -->
					</ul>
				</li>
				<li class="nav-item">
					<a href="/buyer/contact#/blist" class="nav-link {{ Route::is('buyer.contact') ? 'active' : '' }}">
						<i class="nav-icon fas fa-address-book"></i>
						<p>{{ __('Contacts') }}</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
<!-- /.sidebar -->
</aside>
