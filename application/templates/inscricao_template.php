<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>{title}</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
{css}
{js}
</head>
<body>
	<header class="container">
		<h1 id="logo" class="ir"><?php echo anchor('/', "Página Inicial", array()); ?></h1>
	</header>	
	<div id="conteudo" class="container clearfix">
		{conteudo}
	</div>
	<footer>
		<div class="center">Comunidade Católica Shalom &copy; Todos os direitos reservados</div>
	</footer>
</body>
</html>