<?php echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>

<?php
	echo $this->Form->create("Booking", array('type' => 'post'));
	echo $this -> Form -> input('id');
	echo $this -> Form -> input('checkin', array('value' => 'COC1022'));
	echo $this->Form->input('PaymentItem.0.price', array('label' => 'Total Tariff','div' => false));
	echo $this->Form->hidden('PaymentItem.0.name', array('value'=>'Accommodation', 'div' => false)); 
	echo $this->Form->hidden('PaymentItem.0.description', array('value'=>'Accommodation', 'div' => false));
	
	echo $this->Form->input('PaymentItem.1.price', array('label' => "Deposit Amount",'div' => false));
	echo $this->Form->hidden('PaymentItem.1.name', array('value'=>'Deposit', 'div' => false));
	echo $this->Form->hidden('PaymentItem.1.description', array('value'=>'Deposit', 'div' => false));
	//echo $this -> Form -> input('PaymentItem');
	echo $this -> Form -> end("Submit");
?>

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