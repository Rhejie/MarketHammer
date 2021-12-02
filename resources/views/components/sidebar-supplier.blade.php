<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<!-- <a href="../index3.html" class="brand-link">
		<span class="brand-text font-weight-light">Main Navigation</span>
	</a> -->

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
	<!-- 	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Alexander Pierce</a>
			</div>
		</div> -->

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="/supplier" class="nav-link {{  Request::path() == 'supplier' ? 'active' : '' }}">
						<i class="nav-icon fas fa-briefcase"></i>
						<p>{{ __('My Company') }}</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/supplier/product" class="nav-link {{ Route::is('product') ? 'active' : '' }}">
						<i class="nav-icon fas fa-box"></i>
						<p>{{ __('Products') }}</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/supplier/machine" class="nav-link {{ Route::is('machine') ? 'active' : '' }}">
						<i class="nav-icon fas fa-hdd"></i>
						<p>{{ __('Machines') }}</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/supplier/message" class="nav-link {{ Route::is('message') ? 'active' : '' }}">
						<i class="nav-icon fas fa-envelope"></i>
						<p> {{ __('Message') }}<!-- <span class="badge badge-danger navbar-badge">3</span> --></p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/supplier/certification" class="nav-link {{ Route::is('certification') ? 'active' : '' }}">
						<i class="nav-icon fas fa-certificate"></i>
						<p>{{ __('Certifications') }}</p>
					</a>
				</li>
				<!-- <li class="nav-item">
					<a href="/supplier" class="nav-link {{ Route::is('setting.industry-type.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Processes
						</p>
					</a>
				</li> -->
				<li class="nav-item">
					<a href="/supplier/contact#/slist" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">
						<i class="nav-icon fas fa-address-book"></i>
						<p>{{ __('Contacts') }}</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="/supplier/rfq#/supplier-rfq-list" class="nav-link {{ Route::is('rfq') ? 'active' : '' }}">
						<i class="nav-icon fas fa-file-alt"></i>
						<p>{{ __('RFQ') }}</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="http://hq.hubshake.posbang.com/" class="nav-link" target="_blank">
						<i class="nav-icon fas fa-clipboard-list"></i>
						<p>{{ __('Orders') }}</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="/supplier/permission#" class="nav-link {{ Route::is('permission') ? 'active' : '' }}">
						<i class="nav-icon fas fa-key"></i>
						<p>{{ __('Permission') }}</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
<!-- /.sidebar -->
</aside>
