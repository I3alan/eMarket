<?php
/****** Copyright © 2018 eMarket ******* 
*   GNU GENERAL PUBLIC LICENSE v.3.0   *    
* https://github.com/musicman3/eMarket *
***************************************/

	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/configure/configure.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/configure/connect.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/classes/pdo.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/router_out.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/lang_router.php');

	require_once($_SERVER['DOCUMENT_ROOT'].'/model/html_start.php');

	//LOAD TEMPLATE
	$View = new Model\Classes\View\ViewClass;
	require_once($View->Routing());

	//END CONNECT DATABASE
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/connect_page_end.php');

?>