<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>{title}</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup,
  menu, nav, section { display: block; }
</style>
<?php
if(ENVIRONMENT == 'production'){
	echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
}else{
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.min.js"></script>';
}
?>
{css}
{js}
</head>
<body>
  <header class="wrap">
      <h1 id="logo" class="ir home"></h1>
      <?php echo anchor('/inscricao/info/participante', 'Participante', 'id="participante" class="ir"') ?>
  </header>
    <div class="wrap">
        <div id="conteudo" class="clearfix">
        	<div id="cartaz">
				<a target="_blank" href="<?php echo assets_url('image')?>cartaz-acamps.jpg" title="Clique para ver o cartaz no tamanho grande"><img src="<?php echo assets_url('image')?>cartaz-acamps-thumb.jpg"  alt="Clique para ver o cartaz no tamanho grande" /></a></div>
            <div id="form-links">
			    <p class="adote-um-jovem"><?php echo anchor('/inscricao/adote','Adote um Jovem') ?></p>
			    <p><?php echo anchor('/inscricao/info/servico', 'Inscrição do Serviço') ?></p>
			    <p><?php echo anchor('/inscricao/cv', 'Inscrição da Comunidade de Vida') ?></p>
			</div>
        </div>
    </div>
  <footer>
    <div class="wrap center">
      Comunidade Católica Shalom &copy; Todos os direitos reservados
    </div>
  </footer>
</body>
<?php if(isset($velho)): ?>
<script>
	$(function(){
		$("body").addClass("v80");
	});
</script>
<?php endif ?>
</html>