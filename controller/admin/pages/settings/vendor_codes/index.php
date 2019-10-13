<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */
// 
// Если нажали на кнопку Добавить
if ($VALID->inPOST('add')) {

    // Если есть установка по-умолчанию
    if ($VALID->inPOST('default_vendor_code')) {
        $default_vendor_code = 1;
    } else {
        $default_vendor_code = 0;
    }

    // Получаем последний id и увеличиваем его на 1
    $id_max = \eMarket\Core\Pdo::selectPrepare("SELECT id FROM " . TABLE_VENDOR_CODES . " WHERE language=? ORDER BY id DESC", [lang('#lang_all')[0]]);
    $id = intval($id_max) + 1;

    // Оставляем один экземпляр значения по-умолчанию
    if ($id > 1 && $default_vendor_code != 0) {
        \eMarket\Core\Pdo::inPrepare("UPDATE " . TABLE_VENDOR_CODES . " SET default_vendor_code=?", [0]);
    }

    // добавляем запись для всех вкладок
    for ($x = 0; $x < $LANG_COUNT; $x++) {
        \eMarket\Core\Pdo::inPrepare("INSERT INTO " . TABLE_VENDOR_CODES . " SET id=?, name=?, language=?, vendor_code=?, default_vendor_code=?", [$id, $VALID->inPOST('name_vendor_codes_' . $x), lang('#lang_all')[$x], $VALID->inPOST('vendor_code_' . $x), $default_vendor_code]);
    }

    // Выводим сообщение об успехе
    $_SESSION['message'] = ['success', lang('action_completed_successfully')];
}

// Если нажали на кнопку Редактировать
if ($VALID->inPOST('edit')) {

    // Если есть установка по-умолчанию
    if ($VALID->inPOST('default_vendor_code_edit')) {
        $default_vendor_code = 1;
    } else {
        $default_vendor_code = 0;
    }

    // Оставляем один экземпляр значения по-умолчанию
    if ($default_vendor_code != 0) {
        \eMarket\Core\Pdo::inPrepare("UPDATE " . TABLE_VENDOR_CODES . " SET default_vendor_code=?", [0]);
    }

    for ($x = 0; $x < $LANG_COUNT; $x++) {
        // обновляем запись
        \eMarket\Core\Pdo::inPrepare("UPDATE " . TABLE_VENDOR_CODES . " SET name=?, vendor_code=?, default_vendor_code=? WHERE id=? AND language=?", [$VALID->inPOST('name_vendor_codes_edit_' . $x), $VALID->inPOST('vendor_code_edit_' . $x), $default_vendor_code, $VALID->inPOST('edit'), lang('#lang_all')[$x]]);
    }

    // Выводим сообщение об успехе
    $_SESSION['message'] = ['success', lang('action_completed_successfully')];
}

// Если нажали на кнопку Удалить
if ($VALID->inPOST('delete')) {

    // Удаляем
    \eMarket\Core\Pdo::inPrepare("DELETE FROM " . TABLE_VENDOR_CODES . " WHERE id=?", [$VALID->inPOST('delete')]);
    // Выводим сообщение об успехе
    $_SESSION['message'] = ['success', lang('action_completed_successfully')];
}

//КНОПКИ НАВИГАЦИИ НАЗАД-ВПЕРЕД И ПОСТРОЧНЫЙ ВЫВОД ТАБЛИЦЫ
$lines = \eMarket\Core\Pdo::getColRow("SELECT id, name, vendor_code, default_vendor_code FROM " . TABLE_VENDOR_CODES . " WHERE language=? ORDER BY id DESC", [lang('#lang_all')[0]]);
$lines_on_page = $SET->linesOnPage();
$navigate = $NAVIGATION->getLink(count($lines), $lines_on_page);
$start = $navigate[0];
$finish = $navigate[1];

//Создаем маркер для подгрузки JS/JS.PHP в конце перед </body>
$JS_END = __DIR__;

?>