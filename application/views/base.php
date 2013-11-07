<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Produkty</title>
		<?php //echo HTML::style(Request::$protocol.'://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css'); ?>
		<?php echo HTML::style(Request::$protocol . '://netdna.bootstrapcdn.com/bootswatch/3.0.0/united/bootstrap.min.css'); ?>
		<?php //echo HTML::style(Request::$protocol . '://netdna.bootstrapcdn.com/bootswatch/3.0.0/cyborg/bootstrap.min.css'); ?>
		<?php echo HTML::style('assets/css/main.css'); ?>
		<?php echo HTML::script('assets/js/jquery-1.10.2.min.js'); ?>
		<?php echo HTML::script('assets/js/main.js'); ?>
	</head>
	<body>
		<div class="navbar-default">
			<div class="container navbar-default">
				<ul class="nav navbar-nav">
					<li class="<?php echo ($activeMenu == 'product/index') ? 'active' : ''; ?>"><a href="<?php echo URL::site('product'); ?>"><?php echo __('Products list'); ?></a></li>
					<li class="<?php echo ($activeMenu == 'attribute/index') ? 'active' : ''; ?>"><a href="<?php echo URL::site('attribute'); ?>"><?php echo __('Attributes list'); ?></a></li>
					<li class="<?php echo ($activeMenu == 'search/index') ? 'active' : ''; ?>"><a href="<?php echo URL::site('search'); ?>"><?php echo __('Search'); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<h1><?php echo HTML::chars($pageName); ?></h1>

			<?php echo $messages; ?>

			<?php echo $content; ?>
		</div>
		<div class="footer">
			<hr>
			<div class="container">

			</div>
		</div>
	</body>
</html>