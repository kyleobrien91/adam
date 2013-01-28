<div class="content">
	<div class="page-header">
		<h1>Edit addon</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<article class="span12">
				<article class='span9'>
					<div class="alert alert-info">
						<p class="lead">You're editing the <? echo $data['PaymentItem']['name']; ?> addon on <? echo $data['Booking']['Guest']['name'];?>'s booking (<? echo $data['Booking']['id']; ?>)</p>
					</div>
					<article class='span4'>
					<?
						echo $this -> Form -> create('BookingPaymentItem', array(
							'inputDefaults' => array(
								'id' => false,
								'div' => array(
											'class' => 'controls'
										),
								'label' => false
							),
							'class' => false,
							'type' => 'post'
							)
						);
						echo $this -> Form -> hidden('id');
						echo $this -> Form -> hidden('booking_id');
						?>
						<fieldset>
							<div class ="control-group">
								<?
									echo $this -> Form -> label("Quantity", null, array('class' => 'cntrol-label'));
									echo $this -> Form -> input('BookingPaymentItem.quantity', array(
										'class' => 'input-small',
									));
								?>
							</div>
						<?
						echo $this -> Form -> end(array('label' => 'Update', 'class' => 'btn btn-wuxia', 'div' => array('class' => "form-actions")));
					?>
					</article>
				</article>
			</article>
			<? //var_dump($data); ?>
		</div>
	</div>
</div>