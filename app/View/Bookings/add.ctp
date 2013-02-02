<?php echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>

<div class="content">
	<div class="page-header">
		<h1>Create a Booking</h1>
	</div>
	<div class="page-container">
		<div class="row">
			<? echo $this -> Form -> create('Booking', array('class'=>'form', 'inputDefaults' => array('class' => 'input-large','div' => array('class' => 'controls')))); ?>
			<article class="span6">
				<legend>Booking Details</legend>
				<fieldset>
					<div class="control-group">
						<div class="controls">
							<? echo $this->Form->input('booking_source_id', array('options' => $bookingSources,'label' => 'Booking Source', 'data-placeholder' => 'Choose a Booking Source...', 'class' => 'input-large chzn-select')); ?>
						</div>
					</div>
					<div class="control-group">
						<? echo $this->Form->hidden('user_id', array('value' => $user['id'])); ?>
						
						<? echo $this->Form->input('property_id', array('options' => am(array(''=>''), $properties),'label' => 'Property', 'data-placeholder' => 'Choose a Property...', 'class' => 'input-large chzn-select')); ?>
					</div>
					<div class="control-group">
						<div class="controls">
							<div class="input-append">
								<?  echo $this-> Form -> input('checkin', array('value'=>Date('Y-m-d'),'type'=>'text','label' => 'Check In', 'class' => 'datepicker', 'div' => false)); ?>
								<span class="add-on"><i class="awe-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<div class="input-append">
								<?  echo $this-> Form -> input('checkout', array('value'=>Date('Y-m-d'),'type'=>'text','label' => 'Check Out', 'class' => 'datepicker', 'div' => false)); ?>
								<span class="add-on"><i class="awe-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="control-group">
						<? echo $this->Form->input('guest_id', array('default' => $default_guest, 'options' => am(array(''=>''), $guests),'label' => 'Guest', 'data-placeholder' => 'Choose a Guest...', 'class' => 'input-large chzn-select')); ?>
					</div>
					<div class="control-group">
						<? echo $this-> Form -> input('ownervisible', array('label'=> 'Visible to Owner')); ?>
					</div>
				</fieldset>
			</article>
			<article class="span6">
				<legend>
					Occupants
				</legend>
				<fieldset>
					<div class="control-group">
						<? echo $this->Form->input('adults', array('label'=> 'Adults')) ;?>
					</div>
					<div class="control-group">
						<? echo $this->Form->input('children', array('label'=> 'Children')) ;?>
					</div>
					<div class="control-group">
						<? echo $this->Form->input('infants', array('label'=> 'Infants')) ;?>
					</div>
				</fieldset>
				<legend>
					Costs
				</legend>
				<fieldset>
					<div class="control-group">
						<div class="controls">
							<? echo $this->Form->input('PaymentItem.0.price', array('label' => 'Total Tariff','div' => false)) ?>
							<? echo $this->Form->hidden('PaymentItem.0.name', array('value'=>'Accommodation', 'div' => false)); ?>
							<? echo $this->Form->hidden('PaymentItem.0.description', array('value'=>'Accommodation', 'div' => false)); ?>
							<? echo $this->Form->hidden('PaymentItem.0.payment_item_category_id', array('value'=>$accommodationCategoryId['PaymentItemCategory']['id'], 'div' => false)); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input">Deposit Amount &amp; Due Date</label>
						<div class="controls">
							<div class="input-append">
								<? echo $this->Form->input('PaymentItem.1.price', array('label' => false,'div' => false)); ?>
								<? echo $this->Form->hidden('PaymentItem.1.name', array('value'=>'Deposit', 'div' => false)); ?>
								<? echo $this->Form->hidden('PaymentItem.1.description', array('value'=>'Deposit', 'div' => false)); ?>
								<? echo $this->Form->hidden('PaymentItem.1.payment_item_category_id', array('value'=>$depositCategoryId['PaymentItemCategory']['id'], 'div' => false)); ?>
								<? echo $this->Form->input('deposit_due_date' , array('value' => Date('Y-m-d'), 'div' => false,'class' => 'datepicker', 'type' => 'text', 'label' => false)) ?>
								<span class="add-on"><i class="awe-calendar"></i></span>
							</div>
						</div>
					</div>
				</fieldset>
			</article>
			<article class="span12">
				<div class="control-group">
					<button class="btn btn-wuxia btn-large btn-primary" type="submit">
						Create Booking
					</button>
				</div>
			</article>
			</form>
		</div>
	</div>
</div>
<!-- /Main data container --></div>
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