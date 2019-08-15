<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

namespace eMarket\Core;

/**
 * Языковой класс
 *
 * @package Lang
 * @author eMarket
 * 
 */
class Lang {

    /**
     * Подключение и парсинг языковых файлов
     *
     * @param string $default_language (язык по умолчанию)
     * @param string $marker (маркер)
     * @return array $lang|$lang_all|$lang_trans
     */
    function lang($default_language, $marker = null) {

        $TREE = new \eMarket\Core\Tree;
        $SET = new \eMarket\Core\Set;

        //Получаем массив со списком путей к языковым файлам движка
        $engine_path_array = $TREE->filesTree(getenv('DOCUMENT_ROOT') . '/language/' . $default_language . '/' . $SET->path());

        // Получаем список путей к языковым файлам модулей
        $modules_path = getenv('DOCUMENT_ROOT') . '/modules/';
        $modules_info = $TREE->allDirForPath($modules_path, 'true');
        
        // Готовим массив со списком путей к языковым файлам модулей
        $modules_path_array = [];
        foreach ($modules_info as $modules_type => $modules_names_array) {
            foreach ($modules_names_array as $modules_names) {
                $modules_path_array = array_merge($modules_path_array, [$modules_path . $modules_type . '/' . $modules_names . '/language/' . $default_language . '.lng']);
            }
        }

        // Сливаем списки путей к языковым файлам
        $files_path = array_merge($engine_path_array, $modules_path_array);

        //Парсинг языковых файлов
        $lang = parse_ini_file($files_path[0], FALSE, INI_SCANNER_RAW);
        foreach ($files_path as $files) {
            $ini = parse_ini_file($files, FALSE, INI_SCANNER_RAW);
            $lang = array_merge($lang, $ini); // Установка языкового массива
        }

        //Получение списка языков
        $lang_all = []; // массив с языками
        array_push($lang_all, $default_language); // первым в массиве идет язык по умолчанию

        $lang_trans = parse_ini_file(getenv('DOCUMENT_ROOT') . '/language/' . $default_language . '/admin/lang.lng', TRUE, INI_SCANNER_RAW);
        $lang_dir = scandir(getenv('DOCUMENT_ROOT') . '/language/');
        foreach ($lang_dir as $lang_name) {
            // Собираем данные для списка языков
            if (!in_array($lang_name, array('.', '..', $default_language))) {
                array_push($lang_all, $lang_name);
                // Собираем данные из всех general.lng
                $ini_lang = parse_ini_file(getenv('DOCUMENT_ROOT') . '/language/' . $lang_name . '/admin/lang.lng', TRUE, INI_SCANNER_RAW);
                $lang_trans = array_merge($lang_trans, $ini_lang);
            }
        }
        if ($marker == 'all') {
            return $lang_all;
        }
        if ($marker == 'translate') {
            return $lang_trans;
        }

        return $lang;
    }

}

?>