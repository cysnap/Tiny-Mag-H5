<!DOCTYPE HTML>
<html lan="en_US">
<head>
<title>404 | <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
</head>

<body id="main">
	<div class="kudos">
		<div class="kudos-title">
			<a href="<?php echo get_settings('home'); ?>/"><h1>THE MAXIMUN BETA</h1></a>
		</div>
		<div class="kudos-widget">
			<div class="kudos-title"><p>404! YES FOUR ZERO FOUR, YOU KNOW IT!</p></div>
			<div class="keywords clearfix"><h3>HOT TOPICS</h3><?php wp_tag_cloud('smallest=9&largest=15&number=8&orderby=count&order=DESC'); ?></div>
			<div class="keywords">
				<h3>LATEST</h3>
				<ul><?php echo mb_strimwidth(strip_tags(wp_get_archives('type=postbypost&limit=10')), 0, 35,'...') ?></ul>
			</div>
		</div>
	</div>
</body>
</html>
