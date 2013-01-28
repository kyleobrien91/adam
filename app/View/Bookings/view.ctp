<?php echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>
<?php echo $this -> element('secondarynavigation'); ?>
<? //echo $booking['User']['fullname']; ?>
<div class="content">
	<div class="page-header">
		<h1>Booking Information - # <?php echo $bookingid; ?></h1>
	</div>
	<div class="page-container">

		<div class="row">
			<article class="span12">
				<table cellpadding="0" cellspacing="0" class="table">
					<tbody>
						<tr>
							<td align="left"><strong>Booking ID</strong></td>
							<td><strong>
								<?php
									if(isset($bookingid))
										echo $bookingid;
									else {
										echo "None";
									}
								?>
							</strong></td>
						</tr>
						<tr>
							<td align="left">Booking Date</td>
							<td>
								<?php
									if(isset($booking['Booking']['created']))
										echo $booking['Booking']['created'];
									else {
										echo "None";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Property ID</td>
							<td>
								<?php
									if(isset($booking['Booking']['property_id']))
										echo $booking['Booking']['property_id'];
									else {
										echo "None";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Guest Name</td>
							<td>
								<?php
									if(isset($booking['Guest']['name']))
										echo $booking['Guest']['name'];
									else {
										echo "None";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Guest Phone Number</td>
							<td>
								<?php
									if(!empty($booking['Guest']['contactnumberprimary'])) {
										echo $booking['Guest']['contactnumberprimary'];
										if (!empty($booking['Guest']['contactnumbersecondary'])) {
											echo " / " . $booking['Guest']['contactnumbersecondary'];
										}
									} elseif (!empty($booking['Guest']['contactnumbersecondary'])) {
										echo $booking['Guest']['contactnumbersecondary'];
									} else {
										echo "None";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Total Tariff</td>
							<td>
								<?php
									if(isset($accommodation['price']))
										echo $this->Number->currency($accommodation['price'], 'USD');
									else {
										echo $this->Number->currency('0', 'USD');
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Total Paid</td>
							<td>
								<?php
									if(isset($totalPayments))
										echo $this->Number->currency($totalPayments, 'USD');
									else {
										echo $this->Number->currency('0', 'USD');
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Total Due</td>
							<td>
								<?php
								/* 
								if(isset($totalpayments) && isset($bookingproperties['Booking']['tariff']))
								{
									$due = $bookingproperties['Booking']['tariff'] - $totalpayments;
									echo "$ " . $due;
								}
								elseif(isset($bookingproperties['Booking']['tariff'])) {
									echo "$ ". $bookingproperties['Booking']['tariff'];
								}
								 * 
								 */
								 if(isset($bookingArrears)){
								 	echo $this->Number->currency($bookingArrears, 'USD');
								 }
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Check In Date</td>
							<td>
							<?php
								if (!empty($booking["Booking"]["checkin"]))
									echo $booking["Booking"]["checkin"];
								else
									echo "Not set";
							?>
							</td>
						</tr>
						<tr>
							<td align="left">Check Out date</td>
							<td>
							<?php
								if (!empty($booking["Booking"]["checkout"]))
									echo $booking["Booking"]["checkout"];
								else
									echo "Not set";
							?>
							</td>
						</tr>
						<tr>
							<td align="left">Booking taken by</td>
							<td>
							<?php
							if (!$booking["User"]["fullname"]) {
								echo "No one";
							} elseif ($booking["User"]["fullname"]) {
								echo $booking["User"]["fullname"];
							} else {
								echo "Unexpected value. Please alert your developer";
							}
							?>
							</td>
						</tr>
						<tr>
							<td align="left">Added to Stayz:</td>
							<td>
							<?php
							if (!$booking["Booking"]["instayz"]) {
								echo "No";
							} elseif ($booking["Booking"]["instayz"]) {
								echo "Yes";
							} else {
								echo "Unexpected value. Please alert your developer";
							}
							?>
							</td>
						</tr>
						<tr>
							<td align="left">Added to Resonline</td>
							<td>
							<?php
							if (!$booking["Booking"]["inresonline"]) {
								echo "No";
							} elseif ($booking["Booking"]["inresonline"]) {
								echo "Yes";
							} else {
								echo "Unexpected value. Please alert your developer";
							}
							?>	
							</td>
						</tr>
						<tr>
							<td align="left">Added to Console</td>
							<td>
							<?php
							if (!$booking["Booking"]["inconsole"]) {
								echo "No";
							} elseif ($booking["Booking"]["inconsole"]) {
								echo "Yes";
							} else {
								echo "Unexpected value. Please alert your developer";
							}
							?>	
							</td>
						</tr>
						<tr>
							<td align="left">Deposit Paid:</td>
							<td>
								<?php
								if (!$depositPaid) {
									echo "No";
								} elseif ($depositPaid) {
									echo "Yes";
								} else {
									echo "Unexpected value. Please alert your developer";
								}
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Deposit Due:</td>
							<td>
								<?php
								
								echo isset($booking["Booking"]["deposit_due_date"]) ? $booking["Booking"]["deposit_due_date"] : "Not specified";
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Reminder email sent:</td>
							<td>
								<?php
								if (empty($booking["Booking"]["depositemail"]) || $booking["Booking"]["depositemail"] == "0000-00-00")
									echo "No";
								else
									echo $booking["Booking"]["depositemail"];
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Reminder call made:</td>
							<td>
								<?php
								if (empty($booking["Booking"]["depositcall"]) || $booking["Booking"]["depositcall"] == "0000-00-00")
									echo "No";
								else
									echo $booking["Booking"]["depositcall"];
								?>
							</td>
						</tr>
						<tr>
							<td align="left">Booking Active:</td>
							<td>
								<?php
								if (!empty($booking["Booking"]["active"]) && $booking["Booking"]["active"] == TRUE)
									echo "Yes";
								else
									echo "No";
								?>
							</td>
						</tr>
						<tr>
							<td align="left">&nbsp;</td>
							<td>
								<?php echo $this->Html->link("Click here to update this booking", array('controller'=>'bookings','action'=>'edit',$bookingid)); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</article>
		</div>
	</div>
</div>