<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |    
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */
// 
//Если пользователь не авторизован, то устанавливаем язык по умолчанию
if (isset($DEFAULT_LANGUAGE) == FALSE && $PATH != 'install') {
    $DEFAULT_LANGUAGE = DEFAULT_LANGUAGE;
}
//Если первый раз в инсталляторе, то устанавливаем язык по умолчанию Russian
if ($VALID->inPOST('language') == FALSE && $PATH == 'install') {
    $DEFAULT_LANGUAGE = 'russian';
}
//Если переключили язык не авторизованно или в инсталляторе
if ($VALID->inPOST('language') == TRUE) {
    $DEFAULT_LANGUAGE = $VALID->inPOST('language');
}

// Получаем список языков в массиве (для использования в мультиязычных функциях и т.п.)
$lang_all = array(); // массив с языками
$lang_dir = scandir(getenv('DOCUMENT_ROOT') . '/language/');
array_push($lang_all, ucfirst($DEFAULT_LANGUAGE)); // первым в массиве идет язык по умолчанию
foreach ($lang_dir as $lang_name) {
    if (!in_array($lang_name, array('.', '..', ucfirst($DEFAULT_LANGUAGE)))) {
        array_push($lang_all, ucfirst($lang_name));
    }
}

//Подключение и парсинг языковых файлов
$files_path = $TREE->filesTree(getenv('DOCUMENT_ROOT') . '/language/' . $DEFAULT_LANGUAGE . '/' . $PATH);

$parse_temp = parse_ini_file($files_path[0]);
for ($i = 0; $i < count($files_path); $i++) {
    $ini = parse_ini_file($files_path[$i]);
    $lang = array_merge($parse_temp, $ini); // Установка языкового массива
}

/**
 * Функция для вывода языковой переменной вида: lang('pass');
 *
 * @param строка $a
 * @return строка $a
 */
function lang($a) {
    global $lang;

    if (isset($lang[$a])) {
        return $lang[$a]; // Если языковая переменная найдена, то выводим ее значение
    } else {
        return $a; // Если языковая переменная не найдена, то выводим ее название
    }
}

?>