<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

namespace eMarket\Core;

/**
 * Класс для шаблонизатора
 *
 * @package View
 * @author eMarket
 * 
 */
class View {

    /**
     * Роутинг данных из View
     *
     * @return string $str (роутинг на view)
     */
    public function routing() {

        $SET = new \eMarket\Core\Set;

        $str = str_replace('controller', 'view/' . $SET->template(), getenv('SCRIPT_FILENAME'));

        return $str;
    }

    /**
     * Вывод отсортированных слоев в конкретную позицию шаблона
     * 
     * @param string $position (позиция)
     * @return array $array_out (массив настроек позиций для конкретного пути)
     */
    public function layoutRouting($position) {

        $SET = new \eMarket\Core\Set;
        $PDO = new \eMarket\Core\Pdo;

        $array_pos_temp = $PDO->getColRow("SELECT url FROM " . TABLE_TEMPLATE_CONSTRUCTOR . " WHERE group_id=? AND value=? AND page=? ORDER BY sort ASC", [$SET->path(), $position, $SET->titleDir()]);
        if (count($array_pos_temp) > 0) {
            $array_pos = $array_pos_temp;
            $array_out = [];
            foreach ($array_pos as $val) {
                $path_view = str_replace('controller', 'view/' . $SET->template(), $val[0]);
                $array_out[] = $val[0];
                $array_out[] = $path_view;
            }
            return $array_out;
        } else {
            $array_pos = $PDO->getColRow("SELECT url, page FROM " . TABLE_TEMPLATE_CONSTRUCTOR . " WHERE group_id=? AND value=? ORDER BY sort ASC", [$SET->path(), $position]);
            $array_out = [];
            foreach ($array_pos as $val) {
                if ($val[1] == 'all') {
                    $path_view = str_replace('controller', 'view/' . $SET->template(), $val[0]);
                    $array_out[] = $val[0];
                    $array_out[] = $path_view;
                }
            }
            return $array_out;
        }
    }

}

?>