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
	echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
}else{
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.min.js"></script>';
}
?>
{css}
{js}
</head>
<body>
{conteudo}
</body>
</html>