<div class="blow">
	<div class="nav-secondary inverse">
		<nav>
			<ul>
				<li>
					<?php
					echo $this -> Html -> link($this -> Html -> tag('span', " ", array('class' => 'awe-signal')) . "Dashboard", array('controller' => 'bookings', 'action' => 'index'), array('escape' => false));
					?>
				</li>
				<li>
					<?php
					echo $this -> Html -> link($this -> Html -> tag('span', " ", array('class' => 'awe-plus-sign')) . "Add Booking", array(
						'controller' => 'bookings',
						'action' => 'add'
					), array(
						'escape' => false,
					));
					?>
				</li>
				<!--<li>
					<?
					echo $this -> Html -> link($this -> Html -> tag('span', " ", array('class' => 'awe-exclamation-sign')) . "Deposit Due", '/', array(
						'escape' => false,
					));
					?>
				</li>
				<li>
					<a href="#"><span class="awe-money"></span>Final Due</a>
				</li> -->
				<li>
					<a href="#"><span class="awe-calendar"></span>Booking List</a>
				</li>
				<li>
					<a href="#"><span class="awe-signin"></span>Arrivals</a><span class="badge badge-inverse"><? if(isset($arrivals)){ echo $arrivals; } else echo "0"; ?></span>
				</li>
				<li>
					<a href="#"><span class="awe-trash"></span>Cleans</a><span class="badge badge-inverse"><? if(isset($cleans)){ echo $cleans; } else echo "0"; ?></span>
				</li>
			</ul>
		</nav>
	</div>
</div>