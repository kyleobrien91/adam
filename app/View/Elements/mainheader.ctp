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
					<?php
					if ($controller == 'Dashboard' && $action == 'index') {
						echo $this -> Html -> tag('li', null, array('class' => 'active'));
					} else {
						echo $this -> Html -> tag('li');
					}
					echo $this -> Html -> link($this -> Html -> tag('span', " ", array('class' => 'awe-home')), array(
						'controller' => 'bookings',
						'action' => 'index'
					), array(
						'escape' => false,
						'title' => 'Dashboard'
					));
					?>
					</li>
					<?php
					if ($controller == 'Bookings' && $action == 'add') {
						echo $this -> Html -> tag('li', null, array('class' => 'active'));
					} else {
						echo $this -> Html -> tag('li');
					}
					?>
					<?php echo $this -> Html -> link($this -> Html -> tag('span', " ", array('class' => 'awe-plus-sign')), array(
							'controller' => 'bookings',
							'action' => 'add'
						), array(
							'escape' => false,
							'title' => 'Add Booking'
						));
					?>
					</li>
					<li>
						<a href="#" title="Booking List"><span class="awe-calendar"></span></a>
					</li>

					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" title="Site Administration" href="#"><span class="awe-cogs"></span><span class="caret"></span> </a>
						<ul class="dropdown-menu pull-right">
							<li>
								<?php echo $this -> Html -> link("Properties", array(
									'controller' => 'property',
									'action' => 'add'
								), array('escape' => false, ));
								?>
							</li>
							<li>
								<a href="#">Locations</a>
							</li>
							<li>
								<?php
								echo $this -> Html -> link("Owners", array(
									'controller' => 'owners',
									'action' => 'add'
								), array('escape' => false, ));
								?>
							</li>
							<li>
								<a href="#">Add-Ons</a>
							</li>
							<li>
								<? echo $this->Html->link('Users & Roles', array('controller' => 'users', 'action'=> 'add')); ?>
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
							<strong><? echo ucwords($user['firstname'] . " " .$user['lastname'] ); ?></strong><? echo Inflector::humanize($user['role']); ?>
						</div> <span class="caret"></span> </a>
						<ul class="dropdown-menu">
							<li>
								<? echo $this->Html->link('<span class="awe-signout"></span> Logout', array('controller' => 'users', 'action' => 'logout'), array('escape' => false)) ?>
								
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
</header>