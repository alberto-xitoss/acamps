<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>{title}</title>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
{css}
{js}
</head>
<body>
	<div id="header" class="container">
		<h1 id="logo" class="ir"><?php echo anchor('/', "Acamp's", array()); ?></h1>
		<div id="periodo" class="ir">16 à 21 de Janeiro de 2012</div>
	</div>
	<div id="conteudo" class="container clearfix">
		{conteudo}
	</div>
	<div id="footer">
		<div class="container">
			<div class="column-3">
				<h2>Adote um Jovem</h2>
				<p><strong>Faça uma Doação</strong></p>
				<p>(85) 8893 9539 - Célio</p>
				<p>(85) 8728 2609 - Darllan</p>
			</div>
			<div id="social" class="column-3">
				<h2>Fique ligado</h2>
				<p><a href="http://www.facebook.com/projetojuventude" target="_blank"><img src="<?php echo $this->config->item('img_url').'facebook.png' ?>" alt="" />Projeto Juventude</a></p>
				<p><a href="http://twitter.com/pjjfortaleza" target="_blank"><img src="<?php echo $this->config->item('img_url').'twitter.png' ?>" alt="" />@PJJFortaleza</a></p>
			</div>
			<div class="column-3">
				<h2>Realização</h2>
				<div id="pjj" class="ir pull-left">Projeto Juventude para Jesus</div>
				<div id="comshalom" class="ir"><?php echo anchor('http://www.comshalom.org/po/', 'Comunidade Católica Shalom', 'target="_blank"'); ?></div>
			</div>
		</div>
	</div>
</body>
</html>