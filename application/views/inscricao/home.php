<div id="header" class="container">
	<h1 id="logo" class="hide-text"><?php echo anchor('/', "Acamp's", array()); ?></h1>
	<div id="periodo" class="hide-text">2 a 7 de Julho de 2012</div>
</div>
<div class="container">
	<div id="video-frame" class="pull-left">
		<div id="video"><iframe width="400" height="301" src="http://www.youtube.com/embed/FVuQn1qgVKQ" frameborder="0" allowfullscreen></iframe></div>
	</div>
	<div id="insc-links" class="pull-right">
		<h2>Inscreva-se</h2>
		<div>
			<p><?php echo anchor('/inscricao/info/participante', 'Participante', 'id="participante"') ?></p>
			<p><?php echo anchor('/inscricao/info/servico', 'Serviço') ?></p>
			<p><?php echo anchor('/inscricao/cv', 'Comunidade de Vida') ?></p>
		</div>
	</div>
</div>
<div id="footer">
	<div class="container">
		<div class="column-3">
			<h2>Adote um Jovem</h2>
			<p><strong>Faça uma Doação</strong></p>
			<p>(85) 8893 9539 - Célio</p>
		</div>
		<div id="social" class="column-3">
			<h2>Fique ligado</h2>
			<p><a href="http://www.facebook.com/projetojuventude" target="_blank"><img src="<?php echo $this->config->item('img_url').'facebook.png' ?>" alt="" />Projeto Juventude</a></p>
			<p><a href="http://twitter.com/juventudesh" target="_blank"><img src="<?php echo $this->config->item('img_url').'twitter.png' ?>" alt="" />@JuventudeSH</a></p>
		</div>
		<div class="column-3">
			<h2>Realização</h2>
			<div id="pjj" class="hide-text pull-left">Projeto Juventude para Jesus</div>
			<div id="comshalom" class="hide-text pull-left"><?php echo anchor('http://www.comshalom.org/po/', 'Comunidade Católica Shalom', 'target="_blank"'); ?></div>
		</div>
	</div>
</div>