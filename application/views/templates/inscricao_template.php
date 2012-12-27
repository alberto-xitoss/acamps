<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title><?php echo $template['title'] ?></title>
	<meta name="description" content="<?php echo $template['description'] ?>" />
	<meta name="viewport" content="width=device-width">
	<link rel="image_src" href="<?php echo img_url() ?>facebook-thumbnail.jpg" />
	<link rel="stylesheet" href="<?php echo css_url() ?>inscricao.css" />
	<?php echo $template['meta'] ?>
	<?php echo $template['js'] ?>
</head>
<body>
	<div id="header" class="container">
		<h1 id="logo" class="hide-text"><?php echo anchor('/', "Acamp's", array()); ?></h1>
		<div id="periodo" class="hide-text">2 a 7 de Julho de 2012</div>
	</div>
	<?php echo $template['content'] ?>
	<div id="footer">
		<div class="container">
			<div class="column-3">
				<h2>Adote um Jovem</h2>
				<p><strong>Faça uma Doação</strong></p>
				<p>(85) 8690 1014 - Rose</p>
			</div>
			<div id="social" class="column-3">
				<h2>Fique ligado</h2>
				<p><a href="http://www.facebook.com/projetojuventude" target="_blank"><img src="<?php echo img_url() ?>facebook.png" alt="" />Projeto Juventude</a></p>
				<p><a href="http://twitter.com/juventudesh" target="_blank"><img src="<?php echo img_url() ?>twitter.png" alt="" />@JuventudeSH</a></p>
			</div>
			<div class="column-3">
				<h2>Realização</h2>
				<div id="pjj" class="hide-text pull-left">Projeto Juventude para Jesus</div>
				<div id="comshalom" class="hide-text pull-left"><?php echo anchor('http://www.comshalom.org/po/', 'Comunidade Católica Shalom', 'target="_blank"'); ?></div>
			</div>
		</div>
	</div>
</body>
</html>