<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

?>

<div id="log" class="container">
    <div class="row">
        <div class="panel panel-default">

            <div class="panel-heading">
                <!--Выводим уведомление об успешном действии-->
                <?php $MESSAGES->alert('success', lang('action_completed_successfully')); ?>
                <h3 class="panel-title">
                    <div class="pull-left"><?php echo lang('title_'. $SET->titleDir() .'_index') ?></div>
                    <div class="clearfix"></div>
                </h3>
            </div>
            <?php if (file_exists(ROOT . '/model/work/errors.log') == true) { ?>
                <div class="panel-body">
                    <!--<div class="table-responsive">-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="page"><?php echo lang('s') ?> <?php echo $start + 1 ?> <?php echo lang('po') ?> <?php echo $finish ?> ( <?php echo lang('iz') ?> <?php echo count($lines); ?> )</div>
                                </th>

                                <th>

                                    <form>
                                        <?php if (count($lines) > 0) { ?>
                                            <input hidden name="start" value="<?php echo $start ?>">
                                            <input hidden name="finish" value="<?php echo $finish ?>">
                                            <div class="right"><button type="submit" class="btn btn-primary btn-xs" action="index.php" formmethod="post"><span class="glyphicon glyphicon-chevron-right"></span></button></div>
                                        <?php } ?>
                                    </form>

                                    <form>
                                        <?php if (count($lines) > 0) { ?>
                                            <input hidden name="start2" value="<?php echo $start ?>">
                                            <input hidden name="finish2" value="<?php echo $finish ?>">
                                            <div class="left"><button type="submit" class="btn btn-primary btn-xs" action="index.php" formmethod="post"><span class="glyphicon glyphicon-chevron-left"></span></button></div>
                                        <?php } ?>
                                    </form>

                                    <form action="index.php" method="post">
                                        <input hidden name="delete" value="delete">
                                        <div class="left"><button type="submit" name="delete_but" class="btn btn-primary btn-xs" data-toggle="confirmation" data-btn-ok-label="<?php echo lang('confirm-yes') ?>" data-btn-cancel-label="<?php echo lang('confirm-no') ?>" title="<?php echo lang('confirm-del') ?>"><span class="glyphicon glyphicon-trash"> </span></button></div>
                                    </form>

                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            for ($start; $start < $finish; $start++) {

                                if (isset($lines[$start]) == TRUE) {

                                    if (strrpos($lines[$start], 'PHP Notice:') == TRUE) {

                                        ?><tr class="success"><td colspan="2"><?php echo $lines[$start] . '</td></tr>'; ?><?php
                                    } elseif
                                    (strrpos($lines[$start], 'PHP Warning:') == TRUE) {

                                        ?><tr class="warning"><td colspan="2"><?php echo $lines[$start] . '</td></tr>'; ?><?php
                                            } elseif
                                            (strrpos($lines[$start], 'PHP Catchable fatal error:') == TRUE) {

                                                ?><tr class="danger"><td colspan="2"><?php echo $lines[$start] . '</td></tr>'; ?><?php
                                            } elseif
                                            (strrpos($lines[$start], 'PHP Fatal error:') == TRUE) {

                                                ?><tr class="danger"><td colspan="2"><?php echo $lines[$start] . '</td></tr>'; ?><?php
                                            } elseif
                                            (strrpos($lines[$start], 'PHP Parse error:') == TRUE) {

                                                ?><tr class="info"><td colspan="2"><?php echo $lines[$start] . '</td></tr>'; ?><?php } else {

                                                ?><tr><td colspan="2"><?php
                                                        echo $lines[$start] . '</td></tr>';
                                                    }
                                                }
                                            }

                                            ?>

                        </tbody>

                    </table>
                    <!--</div>-->
                </div>
            <?php } else { ?>
                <div class="panel-body"><?php echo lang('no_listing') ?></div>
            <?php } ?>
        </div>
    </div>
</div>