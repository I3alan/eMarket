<?php
// ****** Copyright © 2018 eMarket *****// 
//   GNU GENERAL PUBLIC LICENSE v.3.0   //    
// https://github.com/musicman3/eMarket //
// *************************************//

namespace eMarket\Classes\Core;

class Navigation extends Valid {

    //КНОПКИ НАВИГАЦИИ НАЗАД-ВПЕРЕД И ПОСТРОЧНЫЙ ВЫВОД ТАБЛИЦЫ
    function getNavi($counter, $lines_of_page) {

        //$counter - общее число строк
        //$lines_of_page - число строк на странице

        $start = 0; // устанавливаем страницу в ноль при заходе
        $finish = $lines_of_page;

        if ($counter <= $lines_of_page) {
            $finish = $counter;
        }
        // Если нажали на кнопку вперед GET
        if ($this->inGET('finish')) {
            $finish = $this->inGET('finish') + $lines_of_page; // пересчитываем количество строк на странице
            $start = $this->inGET('start') + $lines_of_page; // задаем значение счетчика
            if ($start >= $counter) {
                $start = $this->inGET('start');
            }
            if ($finish >= $counter) {
                $finish = $counter;
            }
        }
        // Если нажали на кнопку назад GET
        if ($counter >= $lines_of_page) {
            if ($this->inGET('finish2')) {
                $finish = $this->inGET('start2'); // пересчитываем количество строк на странице
                $start = $this->inGET('start2') - $lines_of_page; // задаем значение счетчика
                if ($start < 0) {
                    $start = 0;
                }
                if ($finish < $lines_of_page) {
                    $finish = $lines_of_page;
                }
            }
        }

        // Если нажали на кнопку вперед POST
        if ($this->inPOST('finish')) {
            $finish = $this->inPOST('finish') + $lines_of_page; // пересчитываем количество строк на странице
            $start = $this->inPOST('start') + $lines_of_page; // задаем значение счетчика
            if ($start >= $counter) {
                $start = $this->inPOST('start');
            }
            if ($finish >= $counter) {
                $finish = $counter;
            }
        }
        // Если нажали на кнопку назад POST
        if ($counter >= $lines_of_page) {
            if ($this->inPOST('finish2')) {
                $finish = $this->inPOST('start2'); // пересчитываем количество строк на странице
                $start = $this->inPOST('start2') - $lines_of_page; // задаем значение счетчика
                if ($start < 0) {
                    $start = 0;
                }
                if ($finish < $lines_of_page) {
                    $finish = $lines_of_page;
                }
            }
        }
        $return = array($finish, $start);
        return $return;
    }

}

?>