<?php echo $this -> element('secondarynavigation'); ?>
<? //debug($arrivals); ?>
<div class="content">
	<div class="page-header">
		<h1>Arrivals</h1> 
		<ul class="page-header-actions">
			<li>
				<a href="#" class="btn btn-primary pull-right" target="_blank">View Run Sheet</a>
			</li>
			<li>
				<a href="#" class="btn btn-primary pull-right" target="_blank">View Cleaning Sheet</a>
			</li>
			<li>
				<a href="#" class="btn btn-primary pull-right" target="_blank">View Cleaning Sheet</a>
			</li>
		</ul>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span6">
				<h4>Bookings Arriving Today</h4>
				<? if(!empty($bookingsToday)){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>Property</th>
							<th>Guest Name</th>
							<th>Guest Number</th>
							<th>Arrival</th>
							<th>Arrears</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsToday as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Property']) ? $value['Property']['id'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['name'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['contactnumberprimary'] : "None"; ?></td>
							<td>10:00</td>
							<td>
								<? if($value['Booking']['arrears'] == 0) { ?>
									<span class="label label-success">Paid</span>
								<? } else { ?>
									<span class="label label-important"><? echo $this->Number->currency($value['Booking']['arrears'], 'USD', array('places' => 2)); ?></span>
								<? } ?>
							</td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else {
				?>
					<div class='alert alert-info'>No bookings arriving today</div>
				<?
				} ?>
			</article>
			<article class="span6">
				<h4>Bookings Arriving Tomorrow</h4>
				<? if(!empty($bookingsTomorrow)){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>Property</th>
							<th>Guest Name</th>
							<th>Guest Number</th>
							<th>Arrival</th>
							<th>Arrears</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsTomorrow as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Property']) ? $value['Property']['id'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['name'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['contactnumberprimary'] : "None"; ?></td>
							<td>10:00</td>
							<td>
								<? if($value['Booking']['arrears'] == 0) { ?>
									<span class="label label-success">Paid</span>
								<? } else { ?>
									<span class="label label-important"><? echo $this->Number->currency($value['Booking']['arrears'], 'USD', array('places' => 2)); ?></span>
								<? } ?>
							</td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else {
				?>
					<div class='alert alert-info'>No bookings arriving tomorrow</div>
				<?
				} ?>
			</article>
		</div>
	</div>
</div>

<div class="content">
	<div class="page-header">
		<h1>Deposits Due</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span12">
				<? if(!empty($depositsDue)){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>Property</th>
							<th>Guest Name</th>
							<th>Guest Number</th>
							<th>Email Sent</th>
							<th>Call Made</th>
							<!--<th>Days OD</th>-->
							<th>Arrears</th>
							<th ></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($depositsDue as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Property']) ? $value['Property']['id'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['name'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['contactnumberprimary'] : "None"; ?></td>
							<td><? echo isset($value['Booking']['depositemail']) ? $value['Booking']['depositemail'] : "No"; ?></td>
							<td><? echo isset($value['Booking']['depositcall']) ? $value['Booking']['depositcall'] : "No"; ?></td>
							<!--<td>5</td>-->
							<td>
								<? if($value['Booking']['arrears'] == 0) { ?>
									<span class="label label-success">Paid</span>
								<? } else { ?>
									<span class="label label-important"><? echo $this->Number->currency($value['Booking']['arrears'], 'USD', array('places' => 2)); ?></span>
								<? } ?>
							</td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else {	?>
					<div class='alert alert-info'>No deposits due</div>
				<? } ?>
			</article>
		</div>
	</div>
</div>
<div class="content">
	<div class="page-header">
		<h1 id="finalpaymentsdue">Final Payments Due</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span12">
					<? if(!empty($finalPaymentsDue)){ ?>
				<table class="table">
					<thead>
						<tr>
							<th>Property</th>
							<th >Guest Name</th>
							<th >Guest Number</th>
							<!--<th >Guest Arrived</th>-->
							<!--<th >Days OD</th>-->
							<th >Arrears</th>
							<th ></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($finalPaymentsDue as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Property']) ? $value['Property']['id'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['name'] : "None"; ?></td>
							<td><? echo isset($value['Guest']) ? $value['Guest']['contactnumberprimary'] : "None"; ?></td>
							<!--<td>Yes</td>-->
							<!--<td>8</td>-->
							<td>
								<span class="label label-success">
									<? echo $this->Number->currency($value['Booking']['paid'], 'USD', array('places' => 2)); ?>
								</span> 
								/ 
								<span class="label label-important">
									<? echo $this->Number->currency($value['Booking']['arrears'], 'USD', array('places' => 2)); ?>
								</span>
							</td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else {	?>
					<div class='alert alert-info'>No final payments due</div>
				<? } ?>
			</article>
		</div>
	</div>
</div>
<div class="content">
	<div class="page-header">
		<h1>Booking Housekeeping</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span4">
				<h4> Bookings not in console</h4>
				<? if(!empty($bookingsNotInConsole)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th>Booking ID</th>
							<th >Date Taken</th>
							<th >Booked by</th>
							<th >&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsNotInConsole as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Booking']) ? $value['Booking']['id'] : "None"; ?></td>
							<td><? echo isset($value['Booking']) ? $this->Time->format('Y-m-d', $value['Booking']['created']) : "None"; ?></td>
							<td> </td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-ok"></span>', array('action' => 'addBookingToThirdParty', $value['Booking']['id'], 'console', 'index'), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>All active bookings are in Console</div>
				<? } ?>
			</article>
			<article class="span4">
				<h4> Bookings not in stayz</h4>
				<? if(!empty($bookingsNotInStayz)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th>Booking ID</th>
							<th >Date Taken</th>
							<th >Booked by</th>
							<th >&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsNotInStayz as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Booking']) ? $value['Booking']['id'] : "None"; ?></td>
							<td><? echo isset($value['Booking']) ? $this->Time->format('Y-m-d', $value['Booking']['created']) : "None"; ?></td>
							<td> </td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-ok"></span>', array('action' => 'addBookingToThirdParty', $value['Booking']['id'], 'stayz', 'index'), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>All active bookings are in Stayz</div>
				<? } ?>
			</article>
			<article class="span4">
				<h4> Bookings not in res-online</h4>
				<? if(!empty($bookingsNotInResonline)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th>Booking ID</th>
							<th >Date Taken</th>
							<th >Booked by</th>
							<th >&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsNotInResonline as $key=>$value) { ?>
						<tr>
							<td><? echo isset($value['Booking']) ? $value['Booking']['id'] : "None"; ?></td>
							<td><? echo isset($value['Booking']) ? $this->Time->format('Y-m-d', $value['Booking']['created']) : "None"; ?></td>
							<td> </td>
							<td class="toolbar">
								<div class="btn-group">
									<? echo $this->Html->link('<span class="awe-search"></span>', array('action' => 'view', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-pencil"></span>', array('action' => 'edit', $value['Booking']['id']), array('class' => 'btn btn-flat', 'escape' => false)); ?>
									<? echo $this->Html->link('<span class="awe-ok"></span>', array('action' => 'addBookingToThirdParty', $value['Booking']['id'], 'resonline', 'index'), array('class' => 'btn btn-flat', 'escape' => false)); ?>
								</div>
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>All active bookings are in Res-Online</div>
				<? } ?>
			</article>
		</div>
	</div>
</div>
<div class="content">
	<div class="page-header">
		<h1>Booking Statistics</h1>
		<ul class="page-header-actions">
			<li>
				<? echo $this->Html->link('Create a Booking', array('action' => 'add'), array('class' => 'btn btn-primary pull-right')); ?>
			</li>
		</ul>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span4">
				<h4> Bookings: Today </h4>
				<? if(!empty($bookingsPlacedToday)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th style="width: 17%">Amount</th>
							<th style="width: 30%" >Value</th>
							<th style="width: 53%" >Booking Team Member</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsPlacedToday as $key=>$value) { ?>
							<?if(isset($value['bookings']) && $value['bookings'] > 0){ ?>
								<tr>
									<td><? echo $value['bookings']; ?></td>
									<td><? if(isset($value['value'])) { echo $this->Number->currency($value['value'], 'USD', array('places' => 2));} else{echo "-";}  ?></td>
									<td><? if(isset($value['User']['fullname'])) { echo $value['User']['fullname'];} else{echo "-";} ?></td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>No bookings placed today</div>
				<? } ?>
			</article>
			<article class="span4">
				<h4> Bookings: This Month </h4>
				<? if(!empty($bookingsPlacedThisMonth)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th style="width: 17%">Amount</th>
							<th style="width: 30%" >Value</th>
							<th style="width: 53%" >Booking Team Member</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsPlacedThisMonth as $key=>$value) { ?>
						<?if(isset($value['bookings']) && $value['bookings'] > 0){ ?>
								<tr>
									<td><? echo $value['bookings']; ?></td>
									<td><? if(isset($value['value'])) { echo $this->Number->currency($value['value'], 'USD', array('places' => 2));} else{echo "-";}  ?></td>
									<td><? if(isset($value['User']['fullname'])) { echo $value['User']['fullname'];} else{echo "-";} ?></td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>No bookings placed last week</div>
				<? } ?>
			</article>
			<article class="span4">
				<h4> Bookings: Last Month </h4>
				<? if(!empty($bookingsPlacedLastMonth)){ ?>
				<table  class="table">
					<thead>
						<tr>
							<th style="width: 17%">Amount</th>
							<th style="width: 30%" >Value</th>
							<th style="width: 53%" >Booking Team Member</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($bookingsPlacedLastMonth as $key=>$value) { ?>
						<?if(isset($value['bookings']) && $value['bookings'] > 0){ ?>
								<tr>
									<td><? echo $value['bookings']; ?></td>
									<td><? if(isset($value['value'])) { echo $this->Number->currency($value['value'], 'USD', array('places' => 2));} else{echo "-";}  ?></td>
									<td><? if(isset($value['User']['fullname'])) { echo $value['User']['fullname'];} else{echo "-";} ?></td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
				</table>
				<? } else { ?>
					<div class='alert alert-info'>No bookings placed last month</div>
				<? } ?>
			</article>
		</div>
	</div>
</div>