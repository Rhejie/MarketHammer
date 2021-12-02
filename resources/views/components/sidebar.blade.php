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
					<a href="/backoffice" class="nav-link {{ Route::is('backoffice') ? 'active' : '' }}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							{{ __('Dashboard') }}
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/product" class="nav-link {{  Request::path() == 'product' ? 'active' : '' }}">
						<i class="nav-icon fas fa-th"></i>
						<p>
							{{ __('Products') }}
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview {{ Route::is('business-list.index') ? 'menu-open' : '' }} {{ Request::path() == 'business-contact' ? 'menu-open' : '' }}">
					<a href="#" class="nav-link">
						<!-- <i class="nav-icon fas fa-chart-pie"></i> -->
						<i class="nav-icon fas fa-cubes"></i>
						<p>
							{{ __('Suppliers') }}
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/business-list#/business" class="nav-link {{ Route::is('business-list.index') ? 'active' : '' }}">
								<i class="fas fa-sitemap nav-icon"></i>
								<p>{{ __('Companies') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/business-contact" class="nav-link {{ Request::path() == 'business-contact' ? 'active' : '' }}">
								<i class="fas fa-phone nav-icon"></i>
								<p>{{ __('Contacts') }}</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tree"></i>
						<p>
							{{ __('Buyers') }}
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-users"></i>
						<p>
							{{ __('Users') }}
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="{{ route('setting.index') }}" class="nav-link {{ Route::is('setting.*') ? 'active' : '' }}">
						<i class="fas fa-cogs nav-icon"></i>
						<p>
							{{ __('Settings') }}
						</p>
					</a>
				</li>
				<!-- <li class="nav-header">EXAMPLES</li>
				<li class="nav-item">
					<a href="calendar.html" class="nav-link active">
						<i class="nav-icon far fa-calendar-alt"></i>
						<p>
							Calendar
							<span class="badge badge-info right">2</span>
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="gallery.html" class="nav-link">
						<i class="nav-icon far fa-image"></i>
						<p>
							Gallery
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-envelope"></i>
						<p>
							Mailbox
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="mailbox/mailbox.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Inbox</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="mailbox/compose.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Compose</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="mailbox/read-mail.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Read</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>
							Pages
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="examples/invoice.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Invoice</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/profile.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Profile</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/e-commerce.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>E-commerce</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/projects.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Projects</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/project-add.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/project-edit.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Edit</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/project-detail.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Project Detail</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/contacts.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Contacts</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-plus-square"></i>
						<p>
							Extras
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="examples/login.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Login</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/register.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Register</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/forgot-password.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Forgot Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/recover-password.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Recover Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/lockscreen.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Lockscreen</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/legacy-user-menu.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Legacy User Menu</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/language-menu.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Language Menu</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/404.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Error 404</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/500.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Error 500</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/pace.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Pace</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="examples/blank.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Blank Page</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../starter.html" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Starter Page</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">MISCELLANEOUS</li>
				<li class="nav-item">
					<a href="https://adminlte.io/docs/3.0" class="nav-link">
						<i class="nav-icon fas fa-file"></i>
						<p>Documentation</p>
					</a>
				</li>
				<li class="nav-header">MULTI LEVEL EXAMPLE</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fas fa-circle nav-icon"></i>
						<p>Level 1</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-circle"></i>
						<p>
							Level 1
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Level 2</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Level 2
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Level 2</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fas fa-circle nav-icon"></i>
						<p>Level 1</p>
					</a>
				</li>
				<li class="nav-header">LABELS</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-danger"></i>
						<p class="text">Important</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-warning"></i>
						<p>Warning</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-circle text-info"></i>
						<p>Informational</p>
					</a>
				</li> -->
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
<!-- /.sidebar -->
</aside>
