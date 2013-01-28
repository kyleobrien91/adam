<?php $this->extend('default.ctp'); ?>
<?php $this->start('main_navigation'); ?>
<div id="container">
	<header class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".user">
					<span class="awe-user"></span>
				</button>
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".navigation">
					<span class="awe-chevron-down"></span>
				</button>
				<a class="brand" href="/">EvE</a>
				<nav class="nav-collapse navigation">
					<ul class="nav active-arrows" role="navigation">
						<li class="active">
							<a href="#" title="Dashboard"><span class="awe-home"></span></a>
						</li>
						<li>
							<a href="#" title="Add a Booking"><span class="awe-plus-sign"></span></a>
						</li>
						<li>
							<a href="#" title="Booking List"><span class="awe-calendar"></span></a>
						</li>

						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" title="Site Administration" href="#"><span class="awe-cogs"></span><span class="caret"></span> </a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="#">Properties</a>
								</li>
								<li>
									<a href="#">Locations</a>
								</li>
								<li>
									<a href="#">Owners</a>
								</li>
								<li>
									<a href="#">Add-Ons</a>
								</li>
								<li>
									<a href="#">Users &amp; Roles</a>
								</li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
					</ul>
				</nav>
				<nav class="nav-collapse user">
					<div class="user-info pull-right">
						<img src="http://placekitten.com/35/35" alt="User avatar">
						<div class="btn-group">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<div>
								<strong><? echo $this->Auth->user('firstname') ?></strong>Administrator
							</div> <span class="caret"></span> </a>
							<ul class="dropdown-menu">
								<li class="divider"></li>
								<li>
									<? echo $this->Html->link('<span class="awe-signout"></span> Logout', array('controller' => 'users', 'action' => 'logout'), array('escape' => false)) ?>
									<!--<a href="">t</a>-->
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</header>
</div>
<?php $this->end(); ?>