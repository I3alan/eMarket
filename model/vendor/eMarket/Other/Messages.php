<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

namespace eMarket\Other;

class Messages {

    /**
     * Удобное отображение массива при отладке
     *
     * @param строка $a
     * @param строка $b
     * @return <div>сообщение</div>
     */
    public function alert($a, $b) {
        $SET = new \eMarket\Core\Set;
        $VALID = new \eMarket\Core\Valid;
        
        // При обычном POST или GET
        if ($VALID->inPOST('add') OR $VALID->inGET('add') OR $VALID->inPOST('edit') OR $VALID->inGET('edit') OR $VALID->inPOST('delete') OR $VALID->inGET('delete') OR $VALID->inPOST('modify') == 'ok' OR $VALID->inGET('modify') == 'ok') {
            require_once (ROOT . '/view/' . $SET->template() . '/layouts/alert.php');
        }
        
        // При POST и GET по ajax + обновление страницы
        if (isset($_SESSION['message']) && $_SESSION['message'] == 'ok') {
            require_once (ROOT . '/view/' . $SET->template() . '/layouts/alert.php');
            unset($_SESSION['message']);
        }
        // При POST и GET по ajax + обновление страницы
        if ($VALID->inPOST('modify') == 'update_ok' OR $VALID->inGET('modify') == 'update_ok') {
            require_once (ROOT . '/view/' . $SET->template() . '/layouts/alert.php');
            $_SESSION['message'] = 'ok';
        }
    }

}

?>