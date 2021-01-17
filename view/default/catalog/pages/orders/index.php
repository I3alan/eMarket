<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

foreach (\eMarket\Core\View::tlpc('content') as $path) {
    require_once (ROOT . $path);
}
require_once('modal/index.php')
?>

<div id="alert_block"><?php \eMarket\Core\Messages::alert(); ?></div>
<h1><?php echo lang('orders_book') ?></h1>

<div id="ajax_data" class='hidden' data-orders='<?php echo \eMarket\Catalog\Orders::$orders_edit ?>'></div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th colspan="4"><?php echo \eMarket\Core\Pages::counterPage() ?></th>

                <th>

                    <div class="flexbox">
                        <form>
                            <input hidden name="route" value="<?php echo \eMarket\Core\Valid::inGET('route') ?>">
                            <input hidden name="backstart" value="<?php echo \eMarket\Core\Pages::$start ?>">
                            <input hidden name="backfinish" value="<?php echo \eMarket\Core\Pages::$finish ?>">
                            <div class="b-left">
                                <?php if (\eMarket\Core\Pages::$start > 0) { ?>
                                    <button type="submit" class="btn btn-primary btn-xs" formmethod="get"><span class="glyphicon glyphicon-chevron-left"></span></button>
                                <?php } else { ?>
                                    <a type="submit" class="btn btn-primary btn-xs disabled"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                <?php } ?>
                            </div>
                        </form>

                        <form>
                            <input hidden name="route" value="<?php echo \eMarket\Core\Valid::inGET('route') ?>">
                            <input hidden name="start" value="<?php echo \eMarket\Core\Pages::$start ?>">
                            <input hidden name="finish" value="<?php echo \eMarket\Core\Pages::$finish ?>">
                            <div>
                                <?php if (\eMarket\Core\Pages::$finish != \eMarket\Core\Pages::$count) { ?>
                                    <button type="submit" class="btn btn-primary btn-xs" formmethod="get"><span class="glyphicon glyphicon-chevron-right"></span></button>
                                <?php } else { ?>
                                    <a type="submit" class="btn btn-primary btn-xs disabled"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                <?php } ?>
                            </div>
                        </form>
                        <div>

                            </th>
                            </tr>
                            <tr>
                                <th><?php echo lang('orders_number') ?></th>
                                <th class="text-center"><?php echo lang('orders_total') ?></th>
                                <th class="text-center"><?php echo lang('orders_date_added') ?></th>
                                <th class="text-center"><?php echo lang('orders_status') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (\eMarket\Core\Pages::$count > 0) {
                                    for (\eMarket\Core\Pages::$start; \eMarket\Core\Pages::$start < \eMarket\Core\Pages::$finish; \eMarket\Core\Pages::$start++, \eMarket\Core\Pages::lineUpdate()) {
                                        ?>
                                        <tr>
                                            <td><?php echo eMarket\Core\Pages::$table['line']['id'] ?></td>
                                            <td class="text-center"><?php echo json_decode(eMarket\Core\Pages::$table['line']['order_total'], 1)['customer']['total_to_pay_format'] ?></td>
                                            <td class="text-center"><?php echo \eMarket\Core\Settings::dateLocale(eMarket\Core\Pages::$table['line']['date_purchased'], '%c') ?></td>
                                            <td class="text-center"><?php echo json_decode(eMarket\Core\Pages::$table['line']['orders_status_history'], 1)[0]['customer']['status'] ?></td>

                                            <td>
                                                <div class="flexbox">
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#index" data-edit="<?php echo eMarket\Core\Pages::$table['line']['id'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                            </table>
                        </div>
