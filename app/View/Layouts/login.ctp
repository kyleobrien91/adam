<?php /**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this -> Html -> charset(); ?>
		<title><?php echo $title_for_layout; ?></title>
		<?php echo $this -> Html -> meta('icon', 'hotel.ico');

			echo $this -> Html -> css(array(
				'wuxia-blue',
				'custom'
			));
			echo $this -> Html -> script('jquery.min');
		?>
		<script>
			window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')
		</script>
		<?php 
			echo $this -> Html -> script(array('modernizr','selectivizr','bootstrap-alert'));
			echo $this -> fetch('meta');
			echo $this -> fetch('css');
			echo $this -> fetch('script');
		?>
		<script>
			$(document).ready(function() {

				// Navbar tooltips
				$('.navbar [title]').tooltip({
					placement : 'bottom'
				});

				// Content tooltips
				$('[role=main] [title]').tooltip({
					placement : 'top'
				});

				// Dropdowns
				$('.dropdown-toggle').dropdown();

			});
		</script>
	</head>
	<body class='login'>
		<?php //echo $this -> element('mainheader', array("controller" => $this->name, "action" => $this->action)); ?>
		<?php
			
			echo $this -> fetch('content');
		?>
		
		<?php
		echo $this -> Html -> script(array('navigation','bootstrap-affix','bootstrap-tooltip','bootstrap-dropdown','bootstrap-collapse'));

		echo $this -> fetch('lastscript');
		echo $this->Js->writeBuffer();
		?>
	</body>
</html>