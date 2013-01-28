<div class="content">
	<div class="page-header">
		<h1>Remove this addon?</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span12">
				<?
					//var_dump($data);
				?>
				<article class='span8'>
					<div class="alert alert-info"><p class="lead">You're about to remove <? echo $data['PaymentItem']['name']; ?> from <? echo $data['Booking']['Guest']['name']."'s" ?> booking.</p></div>
					<?
					if(!empty($data['Payment'])) {
					?>
					<h6>Please note the following payments made in lieu of this addon</h6>
					<table class="table">
						<thead>
							<tr>
								<th>Date</th>
								<th align="left">Payment Method</th>
								<th align="left">Amount</th>
								<th align="left">Notes</th>
							</tr>
						</thead>
						<tbody>
						<? foreach($data['Payment'] as $key=>$value){ ?>
							<tr>
								<td><? echo $this -> Time -> format('Y-m-d', $value['created']); ?></td>
								<td><? echo $value['PaymentMethod']['description']; ?></td>
								<td><? echo "$ ". $value['amount']; ?></td>
								<td><? echo $value['note']; ?></td>
							</tr>	
						<? } ?>
						</tbody>
					</table>
					<div class="alert">If you remove this addon, all payments made in lieu will be removed as well. If you'd like to preserve this information, consider
					reducing the quantity of this addon to zero rather. Do this <? echo $this->Html -> link('here', array('action' => 'edit', $data['BookingPaymentItem']['id'])); ?>	
					</div>
					<? } ?>
					
					<h5>Confirm deletion?</h5>
					<article class="span*">
					<?
						echo $this -> Form -> create('BookingPaymentItem', array(
							'type' => 'post', 
							'action' => 'confirm_delete', 
							)
						);
						echo $this -> Form -> hidden('source_action', array('value' => 'BookingPaymentItems_delete'));
						echo $this -> Form -> end(array('label' => 'Yes', 'class' => 'btn btn-wuxia'));
						
						echo $this -> Html -> link('or go back', array('controller' => 'bookings', 'action' => 'edit', $data['Booking']['id']));
					?>			
					</article>		
				</article>
			</article>
		</div>
	</div>
</div>