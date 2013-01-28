<header>
	<h1>Sign in</h1>
	<? echo $this -> Session -> flash(); ?>
</header>
<section>
	<?php echo $this -> Form -> create('User'); ?>
	<fieldset>
		<div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><span class="awe-user"></span></span>
					<?php echo $this -> Form -> input('username', array(
							'placeholder' => 'Your username',
							'div' => false,
							'label' => false
						));
					?>
				</div>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><span class="awe-lock"></span></span>
					<? echo $this -> Form -> input('password', array(
							'placeholder' => 'Password',
							'div' => false,
							'label' => false
						));
					?>
				</div>
			</div>
		</div>
		<?php echo $this -> Form -> end(array(
				'label' => 'Login',
				'div' => array('class' => "form-actions"),
				'class' => 'btn btn-wuxia btn-large btn-primary'
			));
		?>
	</fieldset>
	</form>
</section>