<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

if ($VALID->inPOST('email')) {

    $password_hash = $AUTORIZE->passwordHash($VALID->inPOST('password'));

    $PDO->inPrepare("INSERT INTO " . TABLE_CUSTOMERS . " SET firstname=?, lastname=?, email=?, telephone=?, ip_address=?, password=?", [$VALID->inPOST('firstname'), $VALID->inPOST('lastname'), $VALID->inPOST('email'), $VALID->inPOST('telephone'), $SET->ipAdress(), $password_hash]);
}

//Создаем маркер для подгрузки JS/JS.PHP в конце перед </body>
$JS_END = __DIR__;

?>