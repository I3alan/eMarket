<?php
// ****** Copyright © 2018 eMarket *****// 
//   GNU GENERAL PUBLIC LICENSE v.3.0   //    
// https://github.com/musicman3/eMarket //
// *************************************//

?>
<!-- Модальное окно "Добавить" -->
<?php require_once('modal/regions_add.php') ?>
<!-- КОНЕЦ Модальное окно "Добавить" -->

<!-- Дублируем модальные окна Редактирования -->
<?php $k = $i; // дублируем переменную   ?>

<?php for ($k; $k < $lines_p; $k++) { // запускаем цикл формирования модальных окон  ?>

    <!-- Вставляем модальное окно "Редактировать" -->
    <?php //require($VALID->inSERVER('DOCUMENT_ROOT') . '/view/default/admin/pages/settings/modal/regions_edit.php') ?>

<?php } ?>

<div id="ajax">
    <div id="settings" class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="pull-left"><?php echo $lang['title_regions'] ?></div>
                        <div class="clearfix"></div>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <?php if ($lines == TRUE) { ?>
                                        <div class="log-page"><?php echo $lang['s'] ?> <?php echo $i + 1 ?> <?php echo $lang['po'] ?> <?php echo $lines_p ?> ( <?php echo $lang['iz'] ?> <?php echo $counter ?> )</div>
                                        <?php
                                    } else {

                                        ?>
                                        <div class="log-page"><?php echo $lang['no_regions'] ?></div>
                                    <?php } ?>
                                </th>

                                <th>
                                    <form>
                                        <?php if ($counter > $lines_page) { ?>
                                            <input hidden name="i" value="<?php echo $i ?>">
                                            <input hidden name="lines_p" value="<?php echo $lines_p ?>">
                                            <input hidden name="country_id" value="<?php echo $VALID->inGET('country_id') ?>">
                                        <?php } ?>
                                        <div class="log-right"><button type="submit" class="btn btn-primary btn-xs" action="/controller/admin/pages/settings/regions.php" formmethod="get"><span class="glyphicon glyphicon-chevron-right"></span></button></div>
                                    </form>


                                    <form>
                                        <?php if ($counter > $lines_page) { ?>
                                            <input hidden name="i2" value="<?php echo $i ?>">
                                            <input hidden name="lines_p2" value="<?php echo $lines_p ?>">
                                            <input hidden name="country_id" value="<?php echo $VALID->inGET('country_id') ?>">
                                        <?php } ?>
                                        <div class="log-left"><button type="submit" class="btn btn-primary btn-xs" action="/controller/admin/pages/settings/regions.php" formmethod="get"><span class="glyphicon glyphicon-chevron-left"></span></button></div>
                                    </form>

                                    <div class="log-left">
                                        <a href="#regions_add" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a>
                                    </div>
                                </th>
                            </tr>
			    <?php if ($lines == TRUE) { ?>
                            <tr class="border">
                                <th><?php echo $lang['name_region'] ?></th>
                                <th class="al-text"><?php echo $lang['region_code'] ?></th>
                                <th class="al-text-w"></th>
                            </tr>
			    <?php } ?>
                        </thead>
                        <tbody>
                            <?php for ($i; $i < $lines_p; $i++) { ?>
                                <tr>
                                    <td><?php echo $lines[$i][2] ?></td>
                                    <td class="al-text"><?php echo $lines[$i][1] ?></td>
                                    <td class="al-text-w">
                                        <form>
                                            <input hidden name="region_delete" value="<?php echo $lines[$i][0] ?>">
                                            <input hidden name="country_id" value="<?php echo $VALID->inGET('country_id') ?>">
                                            <div class="log-right">
                                                <button type="submit" name="region_delete_but" class="btn btn-primary btn-xs" data-toggle="confirmation" data-btn-ok-label="<?php echo $lang['confirm-yes'] ?>" data-btn-cancel-label="<?php echo $lang['confirm-no'] ?>" title="<?php echo $lang['confirm-del'] ?>" action="/controller/admin/pages/settings/regions.php" formmethod="get"><span class="glyphicon glyphicon-trash"> </span></button>
                                            </div>
                                            <div class="log-left">
                                                <a href="#regions_edit<?php echo $lines[$i][1] ?>" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span></a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
