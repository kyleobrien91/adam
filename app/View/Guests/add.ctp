<?php echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>
<div class="content">
	<!-- Page header -->
	<div class="page-header">
		<h1>Add a Guest to the System</h1>
	</div>
	<!-- /Page header -->

	<!-- Page container -->
	<div class="page-container">

		<!-- Grid row -->
		<div class="row">

			<!-- Page grid cell (12 blocks) -->
			<article class="span12">
				<?php echo $this -> Form -> create('Guest', array(
					'type' => 'post',
					'id' => FALSE,
					'class' => 'form-horizontal'
				));
				?>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="input">First Name</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Guest.firstname', array(
								'class' => 'input-xlarge',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Last Name</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Guest.lastname', array(
								'class' => 'input-xlarge',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Primary Contact Number</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Guest.contactnumberprimary', array(
								'class' => 'input-xlarge',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Secondary Contact Number</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Guest.contactnumbersecondary', array(
								'class' => 'input-xlarge',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Email Address</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Guest.email', array(
								'class' => 'input-xlarge',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input">Unique guest number</label>
						<div class="controls">
							<span style="font-size: 13px;"><?php echo $uniqueguestnumber; ?></span>
						<?php echo $this -> Form -> hidden('Guest.guestnumber', array(
									'class' => 'input-xlarge',
									'type' => 'text',
									'id' => 'input',
									'label' => false,
									'div' => false,
									'default' => $uniqueguestnumber
								));
						?>
						</div>
						</div>
						<div class="form-actions">
						<?php echo $this -> Form -> button('Add Guest', array(
								'type' => 'submit',
								'class' => 'btn btn-wuxia btn-large btn-primary'
							));
						?>
						</div>

						<?php echo $this -> Form -> end();	?>
						</fieldset>
						</form>
						</article>
						<!-- /Page grid cell (8 blocks) -->

						</div>
						<!-- /Grid row -->
						</div>
						<!-- /Page container -->

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

								$('.datepicker').datepicker();

							});
						</script>
						<?php $this -> end(); ?>
