<?php
/****** Copyright © 2018 eMarket ******* 
*   GNU GENERAL PUBLIC LICENSE v.3.0   *    
* https://github.com/musicman3/eMarket *
***************************************/

	// Структура меню
	$level = array();
	$menu = array();
	$submenu = array();
	
	//LEVEL 0
	$level[0] = '<span></span><span>Раздел 0</span>';
	
	$menu[0][0] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 0</span>';
	$submenu[0][0][0] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 0</a>';
	$submenu[0][0][1] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 1</a>';
	
	$menu[0][1] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 1</span>';
	$submenu[0][1][0] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 0</a>';
	$submenu[0][1][1] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 1</a>';
	$submenu[0][1][2] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 2</a>';
	$submenu[0][1][3] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 3</a>';
	
	$menu[0][2] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 2</span>';
	
	//LEVEL 1
	$level[1] = '<span></span><span>Раздел 1</span>';
	
	$menu[1][0] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 0</span>';
	$submenu[1][0][0] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 0</a>';
	$submenu[1][0][1] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 1</a>';
	
	$menu[1][1] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 1</span>';
	$submenu[1][1][0] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 0</a>';
	$submenu[1][1][1] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 1</a>';

	$menu[1][2] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 2</span>';
	$submenu[1][2][0] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 0</a>';
	$submenu[1][2][1] = '<span><img src="/view/default/admin/images/icons/" /></span><a href="http://www.mail.ru">Подменю 1</a>';
	
	$menu[1][3] = '<span><img src="/view/default/admin/images/icons/" /></span><span>Меню 3</span>';

	//LEVEL 2
	$level[2] = '<span></span><span>'.$lang['menu_help'].'</span>';
	
	$menu[2][0] = '<span><img src="/view/default/admin/images/icons/16x16/emarket.png" /></span><span>'.$lang['menu_extra'].'</span>';
	$submenu[2][0][0] = '<span><img src="/view/default/admin/images/icons/16x16/wrench_orange.png" /></span><a href="http://#">'.$lang['menu_support'].'</a>';
	
	$menu[2][1] = '<span><img src="/view/default/admin/images/icons/16x16/locale.png" /></span><span>'.$lang['menu_languages'].'</span>';
	//НУЖНО СДЕЛАТЬ ПАРСИНГ СПИСКА ЯЗЫКОВ И ВЫВОД В МЕНЮ
	$submenu[2][1][0] = '<span><img src="/view/default/admin/images/worldflags/ru.png" /></span><a href="http://#">'.$lang['menu_language'].'</a>';
	$submenu[2][1][1] = '<span><img src="/view/default/admin/images/worldflags/gb.png" /></span><a href="http://#">English</a>';
	
	$menu[2][2] = '<span><img src="/view/default/admin/images/icons/16x16/home.png" /></span><a target="_blank" href="/controller/catalog/index.php">'.$lang['menu_catalog'].'</a>';

	//LEVEL 3
	$level[3] = '<span></span><a href="/controller/admin/verify/logout.php">'.$lang['menu_exit'].'</a>';
	

?>

</head>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="padding: 0 5px 0 5px;"><img src="/view/default/admin/images/img.png"></td>
		<td width="330" align="right" style="padding-right: 5px;" >
			<span style="color: #000000;"><b>SSL</b></span>
		</td>
	</tr>
</table>

<div id="administrationMenu" class="ThemeOfficeMainItem">
	
	<ul style="visibility: hidden">
			<?php	for ($i = 0; $i < count($level); $i++) { ?>
			<li>
				<?php echo $level[$i]; ?>
				<ul>
						<?php	for ($x = 0; $x < count($menu[$i]); $x++) { ?>
						<li>
							<?php echo $menu[$i][$x]; ?>
							<ul>
									<?php	for ($y = 0; $y < count($submenu[$i][$x]); $y++) { ?>
									<li>
										<?php echo $submenu[$i][$x][$y]; ?>
									</li>
							<?php } ?>
							</ul>
						</li>
				<?php } ?>
				</ul>
			</li>
	<?php } ?>
	</ul>
	
</div>

<script type="text/javascript"><!--
	cmDrawFromText('administrationMenu', 'hbr', cmThemeOffice, 'ThemeOffice');
//--></script>
