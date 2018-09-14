<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=""><?php echo $site_name; ?></a>
	</div>

	<div class="navbar-collapse collapse">

		<ul class="nav navbar-nav">
			<?php foreach ($menu as $parent => $parent_params): ?>

				<?php if ( empty($page_auth[$parent_params['url']]) || $this->ion_auth->in_group($page_auth[$parent_params['url']]) ): ?>
				<?php if (empty($parent_params['children'])): ?>

					<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
					<li <?php if ($active) echo 'class="active"'; ?>>
						<a href='<?php echo $parent_params['url']; ?>'>
							<?php echo $parent_params['name']; ?>
						</a>
					</li>

				<?php else: ?>

					<?php $parent_active = ($ctrler==$parent); ?>
					<li class='dropdown <?php if ($parent_active) echo 'active'; ?>'>
						<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
							<?php echo $parent_params['name']; ?> <span class='caret'></span>
						</a>
						<ul role='menu' class='dropdown-menu'>
							<?php foreach ($parent_params['children'] as $name => $url): ?>
								<li><a href='<?php echo $url; ?>'><?php echo $name; ?></a></li>
							<?php endforeach; ?>

						</ul>
					</li>
				<?php endif; ?>
				<?php endif; ?>

			<?php endforeach; ?>
			
			<?php if ($this->ion_auth->logged_in()): ?>
				<li><a href='panel/logout';>Logout</a></li>
			<?php else: ?>
				<li><a href='login';>Login</a></li>
				<li><a href='admin';>Admin</a></li>
			<?php endif; ?>
		</ul>

		<?php $this->load->view('_partials/language_switcher'); ?>
		
	</div>

</div>
</nav>
