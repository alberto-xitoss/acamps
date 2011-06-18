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
	echo '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>';
	echo '<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>';
}else{
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.min.js"></script>';
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery-ui.min.js"></script>';
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.ui.datepicker-pt-BR.js"></script>';
}
?>
{css}
{js}
</head>
<body>
	<header class="wrap">
		<h1 id="logo" class="ir"><?php
			echo anchor('/','Página Inicial');
		?></h1>
	</header>	
	<div id="conteudo" class="wrap clearfix">
		{conteudo}
	</div>
	<footer>
		<div class="wrap center">Comunidade Católica Shalom &copy; Todos os direitos reservados</div>
	</footer>
</body>
</html>