<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');
		echo $this->Html->css('bootstrap');
		echo $this->Html->script('custom');
		echo $this->Html->script('bootstrap'); 
		echo $this->Html->script('jquery.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="front">
	<div id="container">
		<div id="content1">
			<div class="container-custom">
				<div class="header-block">
					<?php echo $this->element('header'); ?> 
				</div>
				<div class="main-content-block">
					<div class="container-fluid main-container">
						<div class="col-md-2 sidebar">
							<div class="row"> 
								<?php echo $this->element('left_sidebar'); ?> 
							</div>
						</div>
						<div class="col-md-10 content">
							<?php echo $this->Flash->render(); ?>
							<?php echo $this->fetch('content'); ?>
						</div>
					</div>
				</div>
				<div class="footer-block" >
					<?php echo $this->element('footer'); ?> 
				</div>
			</div> 
		</div>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
	<script type="text/javascript" src="/bzng/js/bootstrap.min.js"></script> 
</body>

</html>
