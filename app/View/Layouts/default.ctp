<?php
	$controller = $this->params['controller'];
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title_for_layout; ?></title
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<?php echo $this->Html->css('bootstrap'); ?>

		<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
		</style>
		<?php echo $this->Html->css('bootstrap-responsive'); ?>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<?php echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes' => '144x144', 'href' => '/img/ico/apple-touch-icon-144-precomposed.png'))."\n";?>
		<?php echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes' => '114x114', 'href' => '/img/ico/apple-touch-icon-114-precomposed.png'))."\n";?>
		<?php echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes' => '72x72', 'href' => '/img/ico/apple-touch-icon-72-precomposed.png'))."\n";?>
		<?php echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'href' => '/img/ico/apple-touch-icon-57-precomposed.png'))."\n";?>
		<?php echo $this->Html->meta('favicon.ico', '/ico/favicon.ico', array('type' => 'icon'))."\n"; ?>

		<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">TankWatch</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="<?php echo ($controller == 'pages' ? 'active' : ''); ?>"><?php echo $this->Html->link('Home', '/');?></li>
							<li class="<?php echo ($controller == 'Tests' ? 'active' : ''); ?>"><?php echo $this->Html->link('Tests', '/Tests');?></li>
							<li class="<?php echo ($controller == 'Results' ? 'active' : ''); ?>"><?php echo $this->Html->link('Results', '/Results');?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>

		</div>

		<?php echo $this->Html->script('jquery-1.9.1.min'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>
	</body>
</html>