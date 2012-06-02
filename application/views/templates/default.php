<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
<head>
	<meta charset=utf-8 />
	<title><?php echo isset($template['title'])?$template['title']:'' ?></title>
	<meta name="description" content="<?php echo isset($template['description'])?$template['description']:'' ?>" />
	<meta name="viewport" content="width=device-width">
	<?php echo $template['meta'] ?>
	<?php echo $template['js'] ?>
</head>
<body>
	<?php echo $template['content'] ?>
</body>
</html>