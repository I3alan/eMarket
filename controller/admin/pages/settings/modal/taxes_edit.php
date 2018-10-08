<?php
// ****** Copyright © 2018 eMarket *****//
//   GNU GENERAL PUBLIC LICENSE v.3.0   //
// https://github.com/musicman3/eMarket //
// *************************************//
// собираем данные для отображения в Редактировании категорий
if (isset($lines[$k][0]) == TRUE) {
    $name_taxes_edit = array();
    for ($xl = 0; $xl < count($lang_all); $xl++) {
        array_push($name_taxes_edit, $PDO->selectPrepare("SELECT name FROM " . TABLE_TAXES . " WHERE id=? and language=?", [$lines[$k][0], $lang_all[$xl]]));
    }
    $value_taxes_edit = $PDO->selectPrepare("SELECT rate FROM " . TABLE_TAXES . " WHERE id=?", [$lines[$k][0]]);

}

?>
