<?php

/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

$eMarketShippingFree = new \eMarket\Core\Modules\Payment\Cash();

\eMarket\Core\Settings::jsModulesHandler();
// Загружаем разметку модуля
require_once (\eMarket\Core\View::routingModules('view') . '/index.php');
?>