<?php
// ****** Copyright © 2018 eMarket *****// 
//   GNU GENERAL PUBLIC LICENSE v.3.0   //    
// https://github.com/musicman3/eMarket //
// *************************************//
?>
<div id="ajax">

    <div id="category" class="container">
        <div class="row">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="pull-left"><?php echo $lang['menu_categories'] ?></div>
                        <form action="/controller/admin/pages/categories/categories.php" method="post" class="form-inline"><div class="add-xs">Строк на странице: <select name="select_row" class="input-xs form-control" onchange="this.form.submit()"><option>(<?php echo $lines_page ?>)</option><option>20</option><option>35</option><option>50</option><option>75</option><option>100</option></select></div></form>
                        <div class="clearfix"></div>
                    </h3>
                </div>
                <?php if ($lines == TRUE) { ?>
                    <div class="panel-body">
                        <!--<div class="table-responsive">-->

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <div class="log-page"><?php echo $lang['s'] ?> <?php echo $i + 1 ?> <?php echo $lang['po'] ?> <?php echo $lines_p ?> ( <?php echo $lang['iz'] ?> <?php echo $counter; ?> )</div>
					<form>
                                            <input hidden name="i" value="<?php echo $i ?>">
                                            <input hidden name="lines_p" value="<?php echo $lines_p ?>">
                                            <input hidden name="parent_id_temp" value="<?php echo $parent_id ?>">
                                            <div class="log-right"><button type="submit" class="btn btn-primary btn-xs" action="/controller/admin/pages/categories/categories.php" formmethod="post"><span class="glyphicon glyphicon-chevron-right"></span></button></div>
                                        </form>

                                        <form>
                                            <input hidden name="i2" value="<?php echo $i ?>">
                                            <input hidden name="lines_p2" value="<?php echo $lines_p ?>">
                                            <input hidden name="parent_id_temp" value="<?php echo $parent_id ?>">
                                            <div class="log-left"><button type="submit" class="btn btn-primary btn-xs"  action="/controller/admin/pages/categories/categories.php" formmethod="post"><span class="glyphicon glyphicon-chevron-left"></span></button></div>
                                        </form>
                                        <div class="log-left"><button type="submit" name="category_add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addCategory"><span class="glyphicon glyphicon-plus"></span> <?php echo $lang['button_add'] ?></button>
                                            <!-- Модальное окно "Добавить категорию" -->
                                            <?php require_once('modal/categories_add.php') ?>
                                            <!-- КОНЕЦ Модальное окно "Добавить категорию" -->

                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="sort-list">

                                <?php $parent_up = $lines[0][4]; ?>
                                <?php if ($parent_up > 0) { ?>

                                    <tr  colspan="2" class="sortno">
                                        <td  class="sortleft-m" align="left"><div></div></td>
					<td colspan="3" align="left"><form><div><button name="parent_up" value="<?php echo $parent_up ?>" class="btn btn-default btn-xs" title="" action="/controller/admin/pages/categories/categories.php" formmethod="post">....</button></div></form></td>
                                    </tr>

                                <?php } for ($i; $i < $lines_p; $i++) { ?>

                                    <tr class="sort-list" unitid="<?php echo $lines[$i][0] ?>">
                                        <?php if ($lines[$i][8] == 0) { ?>
                                        <td  class="sortyes sortleft-m" align="left"><div><span class="glyphicon glyphicon-move"> </span></div></td>    
					<td class="sortleft" align="left"><form><div><button name="parent_down" value="<?php echo $lines[$i][0] ?>" class="btn btn-default btn-xs" title="<?php echo $lines[$i][1] ?>" action="/controller/admin/pages/categories/categories.php" formmethod="post"><span class="glyphicon glyphicon-folder-open"> </span></button></div></form></td>
                                        <?php } else { ?>
                                        <td  class="sortyes sortleft-m" align="left"><div><span class="glyphicon glyphicon-move"> </span></div></td>    
					<td class="sortleft" align="left"><form><div><button name="parent_down" value="<?php echo $lines[$i][0] ?>" class="btn btn-primary btn-xs" title="<?php echo $lines[$i][1] ?>" action="/controller/admin/pages/categories/categories.php" formmethod="post"><span class="glyphicon glyphicon-folder-open"> </span></button></div></form></td>
                                        <?php } ?>
                                        <td align="left">
                                            <div class="context-one" id="<?php echo $lines[$i][0] ?>"><?php echo $lines[$i][1] ?>
                                                <!-- Модальное окно "Редактировать категорию" -->
                                                <?php require('modal/categories_edit.php') ?>
                                                <!-- КОНЕЦ Модальное окно "Редактировать категорию" -->
                                            </div>
                                        </td>	  
                                    </tr>

                                <?php } ?>

                            </tbody>


                        </table>

                        <!--</div>-->
                    </div>

                <?php } elseif ($lines == FALSE && $VALID->inPOST('parent_down') > 0) { ?>

                    <div class="panel-body">
                        <!--<div class="table-responsive">-->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="log-page"><?php echo $lang['no_cat'] ?></div>
                                    </th>
                                    <th>
                                        <div class="log-right"><button type="submit" name="category_add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addCategory"><span class="glyphicon glyphicon-plus"></span> <?php echo $lang['button_add'] ?></button>
                                            <!-- Модальное окно "Добавить категорию" -->
                                            <?php require_once('modal/categories_add.php') ?>
                                            <!-- КОНЕЦ Модальное окно "Добавить категорию" -->
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="left"><form><div><button name="parent_up" value="<?php echo $VALID->inPOST('parent_down') ?>" class="btn btn-default btn-xs" title="" action="/controller/admin/pages/categories/categories.php" formmethod="post">....</button></div></form></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--</div>-->
                    </div>
                <?php } else { ?>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <div class="log-page"><?php echo $lang['no_cat'] ?></div>
                                    </th>
                                    <th>
                                        <div class="log-right"><button type="submit" name="category_add" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addCategory"><span class="glyphicon glyphicon-plus"></span> <?php echo $lang['button_add'] ?></button>
                                            <!-- Модальное окно "Добавить категорию" -->
                                            <?php require_once('modal/categories_add.php') ?>
                                            <!-- КОНЕЦ Модальное окно "Добавить категорию" -->
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>