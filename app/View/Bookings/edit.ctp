<?php 
echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>
<? debug($testing); ?>
<? //debug($payments); ?>
<div class="content">
	<div class="page-header">
		<h1>Edit a Booking</h1>
		<h2 id="emailcatcher"></h2>
		<ul class="page-header-actions">
			<il class="active demotabs">
			<? 
				echo $this -> Form -> postLink('Send Email Reminder', array('action' => 'sendReminder', $bookingId, 'email'), array('id' => 'emailButton',	'class' => 'btn btn-wuxia btn-primary'));
 			?>
 			</il>
			<li>&nbsp;</li>
			<il class="active demotabs">
				<?echo $this -> Form -> postLink('Make Call Reminder', array('action' => 'sendReminder', $bookingId, 'call'), array('id' => 'callButton',	'class' => 'btn btn-wuxia btn-primary'));?>
 			</il>
		</ul>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span6">
				<?php echo $this -> Form -> create('Booking', array(
					'inputDefaults' => array(
						'label' => false,
						'id' => 'input',
						'div' => array('class' => 'controls'),
						'hiddenField' => false
					),
					'type' => 'post',
					'class' => 'form-horizontal'
				));
 				?>
 				<legend>Booking Details</legend>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="select">Property</label>
							<?php 
							echo $this -> Form -> hidden('id');
							echo $this -> Form -> input('property_id', array(
								'options' => $properties,
								'id' => false,
								'data-placeholder' => "Choose a Property...",
								'class' => 'chzn-select',
							));
							?>
					</div>
					<div class="control-group">
						<label class="control-label" for="select">Check In</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this -> Form -> input('checkin', array(
									'class' => 'datepicker',
									'type' => 'text',
									'div' => false
								));
								?>
								<span class="add-on"><i class="awe-calendar"> </i></span>
							</div>
						</div>
							
					</div>
					<div class="control-group">
						<label class="control-label" for="select">Check Out</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this -> Form -> input('checkout', array(
									'class' => 'datepicker',
									'type' => 'text',
									'div' => false
								));
								?>
								<span class="add-on"><i class="awe-calendar"></i></span>
							</div>
						</div
					</div>
				</fieldset>
				<fieldset>
					<legend>Booking Information</legend>
					<div class="control-group">
						<label class="control-label" for="input">First Name</label>
							<?php echo $this -> Form -> hidden('Guest.id');
							echo $this -> Form -> input('Guest.firstname', array('type' => 'text', ));
							?>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Last Name</label>
							<?php echo $this -> Form -> input('Guest.lastname', array('type' => 'text', )); ?>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Primary Number</label>
							<?php echo $this -> Form -> input('Guest.contactnumberprimary', array('type' => 'text', )); ?>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Secondary Number</label>
							<?php echo $this -> Form -> input('Guest.contactnumbersecondary', array(
								'type' => 'text',
								'datapicker' => 'Kyle'
							));
 ?>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Email Address</label>
						<?php echo $this -> Form -> input('Guest.email', array('type' => 'text', )); ?>
					</div>
				</fieldset>
				<fieldset>
					<legend>Booking Details</legend>
					<div class="control-group">
						<label class="control-label" for="input">Total Tariff</label>
							<?php echo $this -> Form -> hidden('PaymentItem.0.id', array('value' => $accomm['id']));
							echo $this -> Form -> input('PaymentItem.0.price', array(
								'type' => 'text',
								'value' => $accomm['price']
							));
 ?>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Deposit Amount</label>
							<?php echo $this -> Form -> hidden('PaymentItem.1.id', array('value' => $deposit['id']));
							echo $this -> Form -> input('PaymentItem.1.price', array(
								'type' => 'text',
								'value' => $deposit['price']
							));
 ?>
					</div>
					<div class="control-group">
						<label class="control-label" for="select">Deposit Due</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this -> Form -> input('deposit_due_date', array(
									'class' => 'datepicker',
									'type' => 'text',
									'div' => false
								));
								?>
								<span class="add-on"><i class="awe-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Adults</label>
							<?php echo $this -> Form -> input('adults', array('type' => 'text', )); ?>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Children</label>
							<?php echo $this -> Form -> input('children', array('type' => 'text', )); ?>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Infants</label>
							<?php echo $this -> Form -> input('infants', array('type' => 'text', )); ?>
					</div>

					<div class="control-group">
						<!--<label class="control-label" for="optionsCheckbox">Hide from Owner</label>-->
							<label class="checkbox">
								<?php echo $this -> Form -> input('ownervisible', array(
									'div' => false,
									'value' => 1,
									'hiddenfield' => true
								));
								?>
								Hidden from owner until unticked </label>
					</div>
				</fieldset>
				<!--
				<fieldset>
					<legend>Room Configuration</legend>
					<div class="control-group">
						<label class="control-label" for="select">Main Bedroom</label>
							<select data-placeholder="Choose a configuration..." class="chzn-select" style="width:250px;" tabindex="2">
								<option value=""></option>
								<option value="Queen">Queen</option>
							</select>
					</div>
					<div class="control-group">
						<label class="control-label" for="select">Second Bedroom</label>
							<select data-placeholder="Choose a configuration..." class="chzn-select nosearch" style="width:250px;" tabindex="2">
								<option value=""></option>
								<option value="Q">Queen</option>
								<option value="2S">2 x Single Beds</option>
							</select>
					</div>
				</fieldset>
				-->
				<?
				echo $this -> Form -> end(array(
					'label' => 'Update Booking',
					'class' => 'btn btn-wuxia btn-large btn-primary',
					'div' => array('class' => "form-actions")
				));
			?>
			</article>
			<article class="span6">
				<h4> Booking ID # <?php echo $bookingId; ?> </h4>
				<p>
					Booked by : <? echo $userFullName; ?>
				</p>
				<p>
					Booking Source :  <? if(isset($bookingSource)){ echo $bookingSource['BookingSource']['description']; } else echo "Unknown"; ?>
				</p>
						<?php
							if(!empty($paymentgriditems)/*are there add ons to add?*/)
							{
								?>
								<table class="table table-striped">
								<thead>
									<tr>
										<th>Type</th>
										<th align="left">Qty</th>
										<th align="left">Product</th>
										<th align="left">Total Cost</th>
										<th align="left">Arrears</th>
										<th align="left"></th>
									</tr>
								</thead>
								<tbody>
								<?
								/* Display each of the add-ons */
								foreach($paymentgriditems as $key => $value)
								{
								?>
									<tr>
										<td align="center"><? echo $value['name']; ?></td>
										<td align="center"><? echo $value['quantity']; ?></td>
										<td align="center"><? echo ""; ?></td>
										<td align="center"><? echo $this -> Number -> currency($value['total_cost'], 'USD', array('places' => 2)); ?></td>
										<? if($value['arrears'] == 0) { ?>
											<td><span class="label label-success"><? echo "Paid"; ?></span></td>
										<? } else { ?>
											<td><span class="label label-important"><? echo $this -> Number -> currency($value['arrears'], 'USD', array('places' => 2)); ?></span></td>
										<? }
												if($value['category'] == "Addon") {
										?>
										<td class='toolbar'>
											
											<div class='btn-group'>
												<?php echo $this -> Form -> create('BookingPaymentItem', array(
													'inputDefaults' => array(
														'id' => false,
														'div' => false,
														'label' => false
													),
													'class' => false,
													'type' => 'post',
													'action' => 'delete'
												));
												//<a class='btn btn-flat'><span class='awe-wrench'></span></a>
												?>
												
												<? echo $this -> Html -> link("<span class='awe-wrench'></span>", array(
														'controller' => 'BookingPaymentItems',
														'action' => 'edit',
														$value['id']
													), array(
														'escape' => false,
														'class' => 'btn btn-flat'
													));
 ?>
												<? echo $this -> Form -> hidden('id', array('value' => $value['id'])); ?>
												<button type="submit" class='btn btn-flat'><span class='awe-remove'></span></button>
												<? echo $this -> Form -> end(); ?>
											</div>	
										</td>
										<? } else { ?>
										<td>&nbsp;</td>
										<? } ?>
									</tr>
								<? } ?>
								<tr>
									<td align="center">&nbsp;</td>
									<td align="center">&nbsp;</td>
									<td align="center">&nbsp;</td>
									<td align="center"><? echo $this -> Number -> currency($bookingcost, 'USD', array('places' => 2)); ?></td>
									<? if($bookingarrears == 0) { ?>
											<td><span class="label label-success"><? echo "Paid"; ?></span></td>
										<? } else { ?>
											<td><span class="label label-important"><? echo $this -> Number -> currency($bookingarrears, 'USD', array('places' => 2)); ?></span></td>
										<? } ?>
									<td align="center">&nbsp;</td>
								</tr>
								<? } else { ?>
								<div class="alert alert-info">That's odd!. There aren't any payment items attached to this booking. Best contact the administrator of this system</div>
							<? } ?>
						
					</tbody>
				</table>
					<?php echo $this -> Form -> create('BookingPaymentItem', array(
						'inputDefaults' => array(
							'id' => 'input',
							'div' => array('class' => 'controls'),
							'label' => false
						),
						'class' => 'form-horizontal',
						'type' => 'post',
						'action' => 'addPaymentItemToBooking/' . $bookingId
					));
					?>
					<legend>
						Add Ons
					</legend>
					<fieldset>
						<? echo $this -> Form -> hidden('id', array('value' => $this -> Text -> uuid())); ?>
						<? echo $this -> Form -> hidden('booking_id', array('value' => $bookingId)); ?>
						<div class="control-group">
							<?
							echo $this -> Form -> label('Addon', null, array('class' => 'control-label'));
							echo $this -> Form -> input('payment_item_id', array(
								'type' => 'select',
								'id' => false,
								'data-placeholder' => 'Choose an addon...',
								'class' => 'chzn-select',
								'options' => $addons
							));
							?>
						</div>
						<div class="control-group">
							<? echo $this -> Form -> label('Quantity', null, array('class' => 'control-label')); ?>
							<? echo $this -> Form -> input('quantity'); ?>
						</div>
							<? echo $this -> Form -> end(array(
								'label' => 'Add Item to Booking',
								'class' => 'btn btn-wuxia btn-small btn-primary',
								'div' => array('class' => "form-actions")
							));
							?>
					</fieldset>	
				
				<?
					if(empty($payments)) {
					?>
						<div class="alert alert-info">No payments have been made on this booking yet</div>
					<? } else { ?>
						<br />
						<br />
				<h5>Payments made on this booking</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th align="left">Description</th>
							<th align="left">Payment Method</th>
							<th align="left">Amount</th>
							<th align="left">Notes</th>
						</tr>
					</thead>
					<tbody>
						<?
						foreach($payments as $key=>$value) {
							?>
								<tr>
									<td><? echo $this -> Time -> format('Y-m-d', $value['date']); ?></td>
									<td><? echo $value['description']; ?></td>
									<td><? echo $value['method']; ?></td>
									<td><? echo $value['amount']; ?></td>
									<td><? echo $value['note']; ?></td>
								</tr>
							<? } ?>
					</tbody>
				</table>
				<? } ?>

					<?php echo $this -> Form -> create('Payment', array(
		'inputDefaults' => array(
			'id' => 'input',
			'div' => array('class' => 'controls'),
			'label' => false
		),
		'class' => 'form-horizontal',
		'type' => 'post',
		'action' => 'addPaymentToBooking/' . $bookingId
	));
					?>
					<legend>
						Add Payment
					</legend>
					<? echo $this -> Form -> hidden('id', array('default' => $this -> Text -> uuid())); ?>
					<fieldset>
						<div class="control-group">
							<?
							echo $this -> Form -> label('Payment Item', null, array('class' => 'control-label'));
							echo $this -> Form -> input('Payment.booking_payment_item_id', array(
								'type' => 'select',
								'id' => false,
								'data-placeholder' => 'Choose an item to pay for...',
								'class' => 'chzn-select',
								'options' => $paymentItems
							));
							?>
						</div>
						<div class="control-group">
							<?
							echo $this -> Form -> label('Payment Method', null, array('class' => 'control-label'));
							echo $this -> Form -> input('payment_method_id', array(
								'type' => 'select',
								'id' => false,
								'data-placeholder' => 'Choose a payment method...',
								'class' => 'chzn-select',
							));
							?>
							
						</div>
						<div class="control-group">
							<? echo $this -> Form -> label('Amount', null, array('class' => 'control-label'));
							echo $this -> Form -> input('Payment.amount');
							?>
						</div>
						<div class="control-group">							
							<? echo $this -> Form -> label('Notes', null, array('class' => 'control-label'));
							echo $this -> Form -> input('Payment.note');
							?>
						</div>
						</fieldset>
							<? echo $this -> Form -> end(array(
								'label' => 'Add Payment to Booking',
								'class' => 'btn btn-wuxia btn-small btn-primary',
								'div' => array('class' => "form-actions")
							));
							?>
							
			</article>			
		</div>
	</div>
</div>
<?
//echo $this -> Html -> script(array('jquery.jgrowl'));
?>
<div>
	
</div>
<?php $this -> start('lastscript'); ?>
<?php echo $this -> Html -> script('chosen.jquery'); ?>
<script type="text/javascript">
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({
		allow_single_deselect : true
	});
</script>
<!-- Colorpicker -->
<?php echo $this -> Html -> script('bootstrap-datepicker'); ?>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
			format : 'yyyy-mm-dd'
		});

	});
</script>
<?php
$this -> end();
?>