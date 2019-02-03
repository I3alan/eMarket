<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

// собираем данные для отображения в Редактировании категорий
for ($i = $start; $i < $finish; $i++) {
    if (isset($arr_merge['prod'][$i . 'a'][0]) == TRUE) {

        $modal_id_product = $arr_merge['prod'][$i . 'a'][0]; // ID
        $count_lang = $LANG_COUNT;

        for ($x = 0; $x < $count_lang; $x++) {
            $name_edit_temp_product[$x][$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_PRODUCTS . " WHERE id=? and language=?", [$modal_id_product, lang('#lang_all')[$x]]);
            $description_edit_temp_product[$x][$modal_id_product] = $PDO->selectPrepare("SELECT description FROM " . TABLE_PRODUCTS . " WHERE id=? and language=?", [$modal_id_product, lang('#lang_all')[$x]]);
            $keyword_edit_temp_product[$x][$modal_id_product] = $PDO->selectPrepare("SELECT keyword FROM " . TABLE_PRODUCTS . " WHERE id=? and language=?", [$modal_id_product, lang('#lang_all')[$x]]);
            $tags_edit_temp_product[$x][$modal_id_product] = $PDO->selectPrepare("SELECT tags FROM " . TABLE_PRODUCTS . " WHERE id=? and language=?", [$modal_id_product, lang('#lang_all')[$x]]);
        }

        // Цена
        $price_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT price FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Валюта
        $currency[$modal_id_product] = $PDO->selectPrepare("SELECT currency FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($currency as $val) {
            $currency_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_CURRENCIES . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }

        // Количество
        $quantity_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT quantity FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Единицы измерения
        $units[$modal_id_product] = $PDO->selectPrepare("SELECT unit FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($units as $val) {
            $units_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_UNITS . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }

        // Модель
        $model_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT model FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Производитель
        $manufacturer[$modal_id_product] = $PDO->selectPrepare("SELECT manufacturer FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($manufacturer as $val) {
            $manufacturers_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_MANUFACTURERS . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }

        // Дата поступления
        $date_available_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT date_available FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Налог
        $tax[$modal_id_product] = $PDO->selectPrepare("SELECT tax FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($tax as $val) {
            $tax_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_TAXES . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }

        // Значение идентификатора
        $vendor_code_value_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT vendor_code_value FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Идентификатор
        $vendor_code[$modal_id_product] = $PDO->selectPrepare("SELECT vendor_code FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($vendor_code as $val) {
            $vendor_code_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_VENDOR_CODES . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }
        
        // Значение Веса
        $weight_value_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT weight_value FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Вес
        $weight[$modal_id_product] = $PDO->selectPrepare("SELECT weight FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($weight as $val) {
            $weight_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_WEIGHT . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }
        
        // Минимальное количество
        $min_quantity_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT min_quantity FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        // Ед. изм. длины
        $dimension[$modal_id_product] = $PDO->selectPrepare("SELECT dimension FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        foreach ($dimension as $val) {
            $dimension_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT name FROM " . TABLE_LENGTH . " WHERE id=? and language=?", [$val, lang('#lang_all')[0]]);
        }
        
        // Длина
        $lenght_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT lenght FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        
        // Ширина
        $width_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT width FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        
        // Высота
        $height_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT height FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);

        $logo_edit_temp_product[$modal_id_product] = explode(',', $PDO->selectPrepare("SELECT logo FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]), -1);
        $logo_general_edit_temp_product[$modal_id_product] = $PDO->selectPrepare("SELECT logo_general FROM " . TABLE_PRODUCTS . " WHERE id=?", [$modal_id_product]);
        // ПАРАМЕТРЫ ДЛЯ ПЕРЕДАЧИ В МОДАЛ
        $name_edit_product = json_encode($name_edit_temp_product); // Имя
        $description_edit_product = json_encode($description_edit_temp_product); // Описание
        $keyword_edit_product = json_encode($keyword_edit_temp_product); // Keywords
        $tags_edit_product = json_encode($tags_edit_temp_product); // Tags
        $price_edit_product = json_encode($price_edit_temp_product); // Цена
        $currency_edit_product = json_encode($currency_edit_temp_product); // Валюта
        $quantity_edit_product = json_encode($quantity_edit_temp_product); // Количество
        $units_edit_product = json_encode($units_edit_temp_product); // Единицы измерения
        $model_edit_product = json_encode($model_edit_temp_product); // Модель
        $manufacturers_edit_product = json_encode($manufacturers_edit_temp_product); // Производитель
        $date_available_edit_product = json_encode($date_available_edit_temp_product); // Дата поступления
        $tax_edit_product = json_encode($tax_edit_temp_product); // Налог
        $vendor_code_value_edit_product = json_encode($vendor_code_value_edit_temp_product); // Значение идентификатора
        $vendor_code_edit_product = json_encode($vendor_code_edit_temp_product); // Идентификатор
        $weight_value_edit_product = json_encode($weight_value_edit_temp_product); // Значение веса
        $weight_edit_product = json_encode($weight_edit_temp_product); // Вес
        $min_quantity_edit_product = json_encode($min_quantity_edit_temp_product); // Минимальное количество
        $dimension_edit_product = json_encode($dimension_edit_temp_product); // Ед. изм. длины
        $lenght_edit_product = json_encode($lenght_edit_temp_product); // Длина
        $width_edit_product = json_encode($width_edit_temp_product); // Ширина
        $height_edit_product = json_encode($height_edit_temp_product); // Высота
        //
        $logo_edit_product = json_encode($logo_edit_temp_product); // Список изображений
        $logo_general_product = json_encode($logo_general_edit_temp_product); // Главное изображение
    }
}

//$DEBUG->trace($units_edit_temp_product);

if (!isset($modal_id_product)) {
    $modal_id_product = 'false';
    $name_edit_product = ''; // Имя
    $description_edit_product = ''; // Описание
    $keyword_edit_product = ''; // Keywords
    $tags_edit_product = ''; // Tags
    $price_edit_product = ''; // Цена
    $currency_edit_product = ''; // Валюта
    $quantity_edit_product = ''; // Количество
    $units_edit_product = ''; // Единицы измерения
    $model_edit_product = ''; // Модель
    $manufacturers_edit_product = ''; // Производитель
    $date_available_edit_product = ''; // Дата поступления
    $tax_edit_product = ''; // Налог
    $vendor_code_value_edit_product = ''; // Значение идентификатора
    $vendor_code_edit_product = ''; // Идентификатор
    $weight_value_edit_product = ''; // Значение веса
    $weight_edit_product = ''; // Вес
    $min_quantity_edit_product = ''; // Минимальное количество
    $dimension_edit_product = ''; // Ед. изм. длины
    $lenght_edit_product = ''; // Длина
    $width_edit_product = ''; // Ширина
    $height_edit_product = ''; // Высота
    $logo_edit_product = ''; // Список изображений
    $logo_general_product = ''; // Главное изображение
}

?>
