<?php echo $this -> start('addcss');
echo $this -> Html -> css('chosen');
echo $this -> end();
?>
<div class="content">
	<!-- Page header -->
	<div class="page-header">
		<h1>Add a Property to the System</h1>
	</div>
	<!-- /Page header -->

	<!-- Page container -->
	<div class="page-container">

		<!-- Grid row -->
		<div class="row">

			<!-- Page grid cell (12 blocks) -->
			<article class="span12">
				<?php echo $this -> Form -> create('Property', array(
					'type' => 'post',
					'id' => FALSE,
					'class' => 'form-horizontal'
				));
				?>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="input">Property ID</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.id', array(
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
						<label class="control-label" for="input">Description</label>
						<div class="controls">
							<?php echo $this -> Form -> textarea('Property.description', array(
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
						<label class="control-label" for="input">Address</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.addressline1', array(
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
						<label class="control-label" for="input"> </label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.addressline2', array(
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
						<label class="control-label" for="input">Locality</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.addresslocality', array(
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
						<label class="control-label" for="input">Province</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.addressprovince', array(
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
						<label class="control-label" for="input">Postal Code</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.addresspostalcode', array(
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
						<label class="control-label" for="input">Number of bedrooms</label>
						<div class="controls">
							<?php echo $this -> Form -> input('Property.bedrooms', array(
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
						<label class="control-label" for="input">Owner</label>
						<div class="controls">
							<?php echo $this -> Form -> select('Property.owner_id', $fullnameemail, array(
								'class' => 'chzn-select',
								'type' => 'text',
								'id' => 'input',
								'label' => false,
								'div' => false
							));
							?>
						</div>
					</div>

					<div class="form-actions">
						<?php echo $this -> Form -> button('Add Property', array(
							'type' => 'submit',
							'class' => 'btn btn-wuxia btn-large btn-primary'
						));
						?>
					</div>

					<?php echo $this -> Form -> end(); ?>
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
