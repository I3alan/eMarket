<?php
// ****** Copyright © 2018 eMarket *****// 
//   GNU GENERAL PUBLIC LICENSE v.3.0   //    
// https://github.com/musicman3/eMarket //
// *************************************//
?>
<!-- Модальное окно "Добавить категорию" -->
<?php require_once('modal/products_add.php') ?>
<!-- КОНЕЦ Модальное окно "Добавить категорию" -->

<div id="ajax">
    <div id="category" class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="pull-left"><?php echo $lang['title_products'] ?></div>
                        <form action="/controller/admin/pages/stock/categories/categories.php" method="post" class="form-inline">
                            <div class="add-xs"><?php echo $lang['rows_page'] ?>: <select name="select_row" class="input-xs form-control" onchange="this.form.submit()">
                                    <option>(<?php echo $lines_page ?>)</option>
                                    <option>20</option>
                                    <option>35</option>
                                    <option>50</option>
                                    <option>75</option>
                                    <option>100</option>
                                </select>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </h3>
                </div>
                <div class="panel-body">
		    <table class="table table-hover">
			<thead>
                            <tr>
                                <th colspan="7">
                                    <div class="log-page"><?php echo $lang['s'] ?> <?php echo $i + 1 ?> <?php echo $lang['po'] ?> <?php echo $lines_p ?> ( <?php echo $lang['iz'] ?> <?php echo $counter; ?> )</div>
                                    <div class="log-right"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-chevron-right"></span></button></div>
                                    <div class="log-left"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-chevron-left"></span></button></div>
                                </th>
				<tr>
				    <th colspan="3" class="left al-text" align="left">Название</th>
				    <th class="right al-text" align="left">Модель</th>
				    <th class="right al-text" align="left">Ед. изм.</th>
				    <th class="right al-text" align="left">Кол-во</th>
				    <th class="right al-text" align="left">Цена</th>
				</tr>
                            </tr>
                        </thead>
		    </table>
                    <table class="table table-hover">
                        <tbody id="sort-list">
                            <tr class="sortno">
                                <td class="sortleft-mp" align="left"><a href="#" class="btn btn-default btn-xs disabled" role="button" aria-disabled="true">.</a></td>
                                <td colspan="6" align="left"><button class="btn btn-default btn-xs">....</button></td>
                            </tr>
                            <tr class="sort-list">
                                <td class="sortyes sortleft-m" align="left"><span class="glyphicon glyphicon-move"> </span></td>    
                                <td class="sortleft" align="left"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-folder-open"> </span></button></td>
                                <td class="left option" align="left" id="<?php echo $lines[$i][0] ?>">
				    <div class="context-one" id="<?php echo $lines[$i][0] ?>">Название товара пишем вот таким длинным для проверки длинны названия и колонок таблиц
				    </div>
				</td>
                                <td class="right al-text" align="left">MD34-50</td>
				<td class="right al-text" align="left">шт.</td>
                                <td class="right al-text" align="left">5</td>
                                <td class="right al-text" align="left">1200.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
