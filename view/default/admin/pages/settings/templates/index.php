<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

?>

<div id="settings_templates" class="container-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="pull-left"><a class="btn btn-primary btn-xs" href="../"><span class="back glyphicon glyphicon-share-alt"></span></a> Шаблоны</div>
                    <div class="clearfix"></div>
                </h3>
            </div>
            <div class="panel-body">
		<div class="pull-left input-group has-error">
		    <span class="input-group-addon"><span class="glyphicon glyphicon-hand-right"></span></span>
		    <select name="currency_product_stock" id="currency_product_stock" class="input-sm form-control">
			<option>Раз</option>
			<option>Два</option>
		    </select>
		</div>
		<div class="clearfix"></div>
                <div class="center-block">
                    <ul id="sortable1" class="connectedSortable block-ul" style="width:75%">
                        <li class="sortno border list-group-item-success">Название</li>
                    </ul>
                    <ul id="sortable2" class="connectedSortable block-ul" style="width:24.5%">
                        <li class="sortno border list-group-item-success">Название стакан</li>
                        <li class="sortyes">Five</li>
                        <li class="sortyes">Six</li>
                    </ul>
                </div>
                <div class="center-block">
                    <ul id="sortable3" class="connectedSortable2 block-l" style="width:25%;">
                        <li class="sortno border-l list-group-item-info">Название</li>
                    </ul>
                    <ul id="sortable4" class="connectedSortable2 block-m block-c" style="width:25%">
                        <li class="sortno list-group-item-info">Название</li>
                    </ul>
                    <ul id="sortable5" class="connectedSortable2 block-m block-r" style="width:25%;">
                        <li class="sortno border-r list-group-item-info">Название</li>
                    </ul>
                    <ul id="sortable6" class="connectedSortable2 block-ul" style="width:24.5%">
                        <li class="sortno border list-group-item-info">Название стакан</li>
                        <li class="sortyes">Five</li>
                        <li class="sortyes">Six</li>
                    </ul>
                </div>
                <div class="center-block">
                    <ul id="sortable7" class="connectedSortable3 block-ul" style="width:75%">
                        <li class="sortno border list-group-item-success">Название</li>
                    </ul>
                    <ul id="sortable8" class="connectedSortable3 block-ul" style="width:24.5%">
                        <li class="sortno border list-group-item-success">Название стакан</li>
                        <li class="sortyes">Five</li>
                        <li class="sortyes">Six</li>
                    </ul>
                </div>
		<button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang('save') ?></button>
            </div>
        </div>
    </div>
</div>