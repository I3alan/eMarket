<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

/* >-->-->-->  CONNECT PAGE START  <--<--<--< */
require_once(getenv('DOCUMENT_ROOT') . '/model/start.php');
/* ------------------------------------------ */
//
$resize_param = [];
array_push($resize_param, ['125', '94']); // ширина, высота
//
// Загружаем движок EAC
$EAC_ENGINE = $EAC->start(TABLE_CATEGORIES, TABLE_PRODUCTS, $TOKEN, $resize_param);
$idsx_real_parent_id = $EAC_ENGINE[0];
$parent_id = $EAC_ENGINE[1];

// Формируем массив Налог для выпадающего списка
$taxes_all = $PDO->getCol("SELECT name FROM " . TABLE_TAXES . " WHERE language=?", [lang('#lang_all')[0]]);

// Формируем массив Единица измерения для выпадающего списка
$units_all = $PDO->getCol("SELECT unit FROM " . TABLE_UNITS . " WHERE language=?", [lang('#lang_all')[0]]);


// КНОПКИ НАВИГАЦИИ НАЗАД-ВПЕРЕД И ПОСТРОЧНЫЙ ВЫВОД ТАБЛИЦЫ
// 
// Устанавливаем родительскую категорию при навигации назад-вперед
if ($VALID->inGET('parent_id_temp')) {
    $parent_id = $VALID->inGET('parent_id_temp');
}

$lines_on_page = $SET->linesOnPage();
// получаем отсортированное по sort_category содержимое в виде массива для отображения на странице и сортируем в обратном порядке
$lines_cat = $PDO->getColRow("SELECT id, name, parent_id, status FROM " . TABLE_CATEGORIES . " WHERE parent_id=? AND language=? ORDER BY sort_category DESC", [$parent_id, lang('#lang_all')[0]]);
$count_lines_cat = count($lines_cat);  //считаем количество строк

$lines_product = $PDO->getColRow("SELECT id, name FROM " . TABLE_PRODUCTS . " WHERE parent_id=? AND language=? ORDER BY id DESC", [$parent_id, lang('#lang_all')[0]]);
$count_lines_products = count($lines_product);  //считаем количество строк

$arr_merge = $FUNC->arrayMergeOriginKey('cat', 'prod', $lines_cat, $lines_product);
$count_lines_merge = ($count_lines_cat + $count_lines_products);

$navigate = $NAVIGATION->getLink($count_lines_merge, $lines_on_page, 1);
$start = $navigate[0];
$finish = $navigate[1];
//print_r($start2 . '--' . $finish2);
//$DEBUG->trace($arr_merge);

// КОНЕЦ-> КНОПКИ НАВИГАЦИИ НАЗАД-ВПЕРЕД И ПОСТРОЧНЫЙ ВЫВОД ТАБЛИЦЫ
//Создаем маркер для подгрузки JS/JS.PHP в конце перед </body>
$JS_END = __DIR__;

/* ->-->-->-->  CONNECT PAGE END  <--<--<--<- */
require_once(ROOT . '/model/end.php');
/* ------------------------------------------ */

?>
