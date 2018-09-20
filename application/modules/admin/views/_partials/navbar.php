<header class="main-header">
	<a href="" class="logo visible-sm visible-md visible-lg"><b><?php echo $site_name; ?></b></a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<a href="" class="navbar-custom-title" role="button"><b><?php echo $site_name; ?></b></a>
		<div class="navbar-custom-menu"> <!-- hidden-sm hidden-xs"> -->
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs"><?php echo $user->first_name; ?></span>
						<span class="visible-xs fa fa-user-circle-o" style="margin-right: 0px; font-size: 20px; text-align: center;"></span>
					</a>
					<ul class="dropdown-menu">
					 <li>
					 	<a style="margin: 10px 10px; color: #000;" title="Account" href="panel/account">
					 		<i class="fa fa-user"></i>
					 		&nbsp;&nbsp;Account
					 	</a>
					 	<hr style="margin: 10px 10px; color: #eee;">
					 	<a style="margin: 10px 10px; color: #000;" title="Account" href="panel/logout">
					 		<i class="fa fa-sign-out"></i>
					 		&nbsp;&nbsp;Sign Out
					 	</a>					 	
					 </li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
