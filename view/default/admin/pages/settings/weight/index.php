<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

require_once('modal/index.php')
?>

<div id="settings_weight">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div id="alert_block"><?php \eMarket\Core\Messages::alert(); ?></div>
            <h3 class="panel-title">
                <span class="settings_back"><button type="button" onClick='location.href = "<?php echo \eMarket\Core\Settings::parentPartitionGenerator() ?>"' class="btn btn-primary btn-xs"><span class="back glyphicon glyphicon-share-alt"></span></button></span><span class="settings_name"><?php echo \eMarket\Core\Settings::titlePageGenerator() ?></span>
            </h3>
        </div>
        <div class="panel-body">
            <div id="ajax_data" class='hidden' data-jsondata='<?php echo \eMarket\Admin\Weight::$json_data ?>'></div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="4"><?php echo \eMarket\Core\Pages::counterPage() ?></th>

                            <th>
                                <div class="flexbox">

                                    <div class="b-left"><a href="#index" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a></div>

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

                                </div>
                            </th>
                        </tr>
                        <?php if (\eMarket\Core\Pages::$count > 0) { ?>
                            <tr class="border">
                                <th><?php echo lang('name_full') ?></th>
                                <th class="text-center"><?php echo lang('name_little') ?></th>
                                <th class="text-center"><?php echo lang('value') ?></th>
                                <th class="text-center"><?php echo lang('default') ?></th>
                                <th></th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php for (\eMarket\Core\Pages::$start; \eMarket\Core\Pages::$start < \eMarket\Core\Pages::$finish; \eMarket\Core\Pages::$start++, \eMarket\Core\Pages::lineUpdate()) { ?>
                            <tr>
                                <td><?php echo eMarket\Core\Pages::$table['line']['name'] ?></td>
                                <td class="text-center"><?php echo eMarket\Core\Pages::$table['line']['code'] ?></td>
                                <td class="text-center"><?php echo (float) eMarket\Core\Pages::$table['line']['value_weight'] ?></td>
                                <?php if (eMarket\Core\Pages::$table['line']['default_weight'] == 1) { ?>
                                    <td class="text-center"><?php echo lang('confirm-yes') ?></td>
                                <?php } else { ?>
                                    <td class="text-center"><?php echo lang('confirm-no') ?></td>
                                <?php } ?>
                                <td>
                                    <div class="flexbox">
                                        <div class="b-left">
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#index" data-edit="<?php echo eMarket\Core\Pages::$table['line']['id'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
                                        </div>
                                        <form id="form_delete<?php echo eMarket\Core\Pages::$table['line']['id'] ?>" name="form_delete" action="javascript:void(null);" onsubmit="Ajax.callDelete('<?php echo eMarket\Core\Pages::$table['line']['id'] ?>')" enctype="multipart/form-data">
                                            <input hidden name="delete" value="<?php echo eMarket\Core\Pages::$table['line']['id'] ?>">
                                            <div>
                                                <button type="submit" name="delete_but" class="btn btn-primary btn-xs" data-placement="left" data-toggle="confirmation" data-singleton="true" data-popout="true" data-btn-ok-label="<?php echo lang('confirm-yes') ?>" data-btn-cancel-label="<?php echo lang('confirm-no') ?>" title="<?php echo lang('confirm-del') ?>"><span class="glyphicon glyphicon-trash"> </span></button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>