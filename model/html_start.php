<?php
/****** Copyright © 2018 eMarket ******* 
*   GNU GENERAL PUBLIC LICENSE v.3.0   *    
* https://github.com/musicman3/eMarket *
***************************************/
?>

<!doctype html>
<html dir="ltr" lang="<?php echo $lang['meta-language'] ?>">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex,nofollow" />
<meta name="generator" content="HippoEDIT, Notepad++" />
<meta name="classification" content="software" />
<meta name="author" content="eMarket" />
<meta name="owner" content="eMarket" />
<meta name="copyright" content="Copyright©2018 by eMarket. All right reserved." />
<?php $title_prefix = basename(($_SERVER['REQUEST_URI']), '.php'); // автогенерация префикса title по названию файла. Пример: для index.php = index ?>
<title><?php echo $lang['title_'.$title_prefix] ?></title>
<?php //вывод только в админке
	if ($patch == 'admin'){ ?>
		<link rel="stylesheet" type="text/css" href="/view/default/admin/style.css" media="screen" />
		<link rel="stylesheet" href="/view/default/admin/js/jscookmenu/ThemeOffice/theme.css" type="text/css">
		<script type="text/javascript" src="/view/default/admin/js/jscookmenu/JSCookMenu.js"></script>
		<script type="text/javascript" src="/view/default/admin/js/jscookmenu/ThemeOffice/theme.js"></script>
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT'].'/view/default/admin/header.php');
	} // конец вывода только в админке
	?>
<?php //вывод только в каталоге
	if ($patch == 'catalog'){ ?>
		<link href="/ext/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link href="/ext/bootstrap/css/normalize.css" rel="stylesheet" media="screen" />
		<?php 
	} // конец вывода только в каталоге
	?>