<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

use \eMarket\Core\{
    Ecb,
    Messages,
    Pages,
    Settings,
    Valid
};
use \eMarket\Admin\Stock;
use \eMarket\Admin\Stikers;

require_once('modal/index.php');
require_once('modal/index_product.php');
require_once('modal/confirm.php');
require_once('modal/attribute.php');
require_once('modal/add_group_attributes.php');
require_once('modal/add_attribute.php');
require_once('modal/values_attribute.php');
require_once('modal/add_values_attribute.php');
?>

<div id="stock">
    <div class="card">

        <div class="card-header">

            <div id="alert_block"><?php Messages::alert(); ?></div>

            <h3 class="card-title">
                <?php echo Settings::titlePageGenerator() ?>
            </h3>
        </div>
        <div id="ajax_data" class='hidden' 
             data-jsondataproduct='<?php echo Stock::$json_data_product ?>'
             data-jsondatacategory='<?php echo Stock::$json_data_category ?>'>
        </div>
        <?php if (Stock::$count_lines_merge > 0) { ?>
            <div class="modal-body">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 offset-0">
                    <form>
                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                        <div class="input-group mb-3">
                            <input type="search" id="search" name="search" placeholder="<?php echo lang('search') ?>" class="form-control">
                            <button type="submit" class="bi-search btn btn-primary"></button>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="4"><?php echo Pages::counterPageStock() ?></th>
                                <th>

                                    <div class="flexbox">
                                        <form>
                                            <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                            <input hidden name="backstart" value="<?php echo Stock::$start ?>">
                                            <input hidden name="backfinish" value="<?php echo Stock::$finish ?>">
                                            <input hidden name="nav_parent_id" value="<?php echo Stock::$parent_id ?>">
                                            <div class="b-left">
                                                <?php if (Stock::$start > 0) { ?>
                                                    <button type="submit" class="btn btn-primary btn-sm" action="index.php" formmethod="get"><span class="bi-arrow-left-short"></span></button>
                                                <?php } else { ?>
                                                    <a type="submit" class="btn btn-primary btn-sm disabled"><span class="bi-arrow-left-short"></span></a>
                                                <?php } ?>
                                            </div>
                                        </form>

                                        <form>
                                            <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                            <input hidden name="start" value="<?php echo Stock::$start ?>">
                                            <input hidden name="finish" value="<?php echo Stock::$finish ?>">
                                            <input hidden name="nav_parent_id" value="<?php echo Stock::$parent_id ?>">
                                            <div>
                                                <?php if (Pages::counterStock() < Stock::$count_lines_merge) { ?>
                                                    <button type="submit" class="btn btn-primary btn-sm" action="index.php" formmethod="get"><span class="bi-arrow-right-short"></span></button>
                                                <?php } else { ?>
                                                    <a type="submit" class="btn btn-primary btn-sm disabled"><span class="bi-arrow-right-short"></span></a>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>

                                </th>
                            </tr>
                        </thead>
                        <tbody id="sort-list">

                            <?php
                            if (Stock::$parent_id > 0) {
                                ?>

                                <tr class="sortno">
                                    <td  class="sortleft-m"></td>
                                    <td colspan="4">

                                        <form>
                                            <div>
                                                <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                                <button name="parent_up" value="<?php echo Stock::$parent_id ?>" class="btn btn-outline-secondary btn-sm" title="" action="index.php" formmethod="get"><span class="bi-three-dots"></span></button>
                                            </div>
                                        </form>

                                    </td>
                                </tr>

                                <?php
                            }

                            for (Stock::$start; Stock::$start < Stock::$finish; Stock::$start++, Stock::$transfer++) {

                                if (Stock::$start < Stock::$count_lines_cat) {
                                    ?>

                                    <tr class="<?php echo Settings::sortiesClass('info') ?> sort-list" unitid="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>">

                                        <?php if (!Valid::inGET('search')) { ?>
                                            <td class="sortyes sortleft-m"><div><span class="bi-arrows-move"> </span></div></td>
                                        <?php } else { ?>
                                            <td class="sortleft-m"></td>
                                            <?php
                                        }

                                        if (isset($_SESSION['buffer']['cat']) == true && in_array(Stock::$arr_merge['cat'][Stock::$start]['id'], $_SESSION['buffer']['cat']) == true && Stock::$arr_merge['cat'][Stock::$start]['status'] == 1) {
                                            ?>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-primary btn-sm disabled"><span class="bi-folder2-open"> </span></a></div></td>

                                            <?php
                                        } elseif (isset($_SESSION['buffer']['cat']) == true && in_array(Stock::$arr_merge['cat'][Stock::$start]['id'], $_SESSION['buffer']['cat']) == true && Stock::$arr_merge['cat'][Stock::$start]['status'] == 0) {
                                            ?>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-secondary btn-sm disabled"><span class="bi-folder2-open"> </span></a></div></td>

                                            <?php
                                        } elseif (Stock::$transfer == Settings::linesOnPage() + 1) {
                                            ?>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-primary btn-sm disabled"><span class="bi-arrow-left-right"> </span></a></div></td>

                                            <?php
                                        } elseif (Stock::$arr_merge['cat'][Stock::$start]['status'] == 0) {
                                            ?>    
                                            <td class="sortleft">

                                                <form>
                                                    <div>
                                                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                                        <button name="parent_down" value="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>" class="btn btn-secondary btn-sm" title="<?php echo Stock::$arr_merge['cat'][Stock::$start]['name'] ?>" action="index.php" formmethod="get"><span class="bi-folder2-open"> </span></button>
                                                    </div>
                                                </form>

                                            </td>

                                            <?php
                                        } else {
                                            ?>    
                                            <td class="sortleft">

                                                <form>
                                                    <div>
                                                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                                        <button name="parent_down" value="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>" class="btn btn-primary btn-sm" title="<?php echo Stock::$arr_merge['cat'][Stock::$start]['name'] ?>" action="index.php" formmethod="get"><span class="bi-folder2-open"> </span></button>
                                                    </div>
                                                </form>

                                            </td>
                                            <?php
                                        }
                                        ?>

                                        <td class="option" id="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>"><span class="inactive" style="display: none;"></span>
                                            <?php if (Stock::$transfer == Settings::linesOnPage() + 1) { ?>
                                                <div class="transfer" id="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>"><?php echo lang('categories_transfer') ?></div>
                                            <?php } else { ?>
                                                <div class="context-one" id="<?php echo Stock::$arr_merge['cat'][Stock::$start]['id'] ?>"><?php echo Stock::$arr_merge['cat'][Stock::$start]['name'] ?></div>
                                            <?php } ?>
                                        </td>	
                                        <td class="sortleft-m"></td>
                                        <td class="sortleft-m"></td>
                                    </tr>

                                    <?php
                                }

                                if (Stock::$start >= Stock::$count_lines_cat && Stock::$transfer < Settings::linesOnPage() + 1) {
                                    ?>
                                    <tr>

                                        <?php if (isset($_SESSION['buffer']['prod']) == true && in_array(Stock::$arr_merge['prod'][Stock::$start . 'a']['id'], $_SESSION['buffer']['prod']) == true && Stock::$arr_merge['prod'][Stock::$start . 'a']['status'] == 1) { ?>
                                            <td class="sortleft-m"></td>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-success btn-sm disabled"><span class="bi-cart-check-fill"> </span></a></div></td>

                                        <?php } elseif (isset($_SESSION['buffer']['prod']) == true && in_array(Stock::$arr_merge['prod'][Stock::$start . 'a']['id'], $_SESSION['buffer']['prod']) == true && Stock::$arr_merge['prod'][Stock::$start . 'a']['status'] == 0) { ?>
                                            <td class="sortleft-m"></td>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-secondary btn-sm disabled"><span class="bi-cart-check-fill"> </span></a></div></td>

                                        <?php } elseif (Stock::$arr_merge['prod'][Stock::$start . 'a']['status'] == 0) { ?>
                                            <td class="sortleft-m"></td>    
                                            <td class="sortleft"><div><a href="#" class="btn btn-secondary btn-sm"><span class="bi-cart-check-fill"> </span></a></div></td>
                                        <?php } else { ?>

                                            <td class="sortleft-m"></td>
                                            <td class="sortleft"><div><a href="#" class="btn btn-success btn-sm"><span class="bi-cart-check-fill"> </span></a></div></td>

                                        <?php } ?>
                                        <td class="context-one option" id="product_<?php echo Stock::$arr_merge['prod'][Stock::$start . 'a']['id'] ?>"><span class="inactive" style="display: none;"></span>
                                            <div class="pull-left"><?php echo Stock::$arr_merge['prod'][Stock::$start . 'a']['name'] ?></div>
                                            <div class="pull-right"><?php echo Ecb::priceInterface(Stock::$arr_merge['prod'][Stock::$start . 'a'], 1) ?></div>
                                        </td>

                                        <?php if (json_decode(Stock::$arr_merge['prod'][Stock::$start . 'a']['discount'], 1)) { ?>
                                            <td class="sortleft"><span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<?php echo Settings::productSaleTooltip(Stock::$arr_merge['prod'][Stock::$start . 'a']['discount']) ?>" class="bi-tag-fill text-primary"> </span></td>
                                        <?php } elseif (json_decode(Stock::$arr_merge['prod'][Stock::$start . 'a']['discount'], 1) == 0) { ?>
                                            <td class="sortleft"><span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<?php echo Settings::productSaleTooltip(Stock::$arr_merge['prod'][Stock::$start . 'a']['discount']) ?>" class="bi-tag-fills text-primary"> </span></td>
                                        <?php } else { ?>
                                            <td class="sortleft-m"><span class="bi-tag-fill"></span></td>
                                        <?php } ?>

                                        <?php if (Stock::$arr_merge['prod'][Stock::$start . 'a']['stiker'] != '' && Stock::$arr_merge['prod'][Stock::$start . 'a']['stiker'] != NULL) { ?>
                                            <td class="sortleft"><span class="badge bg-success"><?php echo Stikers::$stiker_name[Stock::$arr_merge['prod'][Stock::$start . 'a']['stiker']] ?></span></td>
                                        <?php } else { ?>
                                            <td class="sortleft-m"></td>
                                        <?php } ?>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <?php
        } elseif (Stock::$count_lines_cat > 0 && Stock::$parent_id > 0) {
            ?>

            <div class="modal-body">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 offset-0">
                    <form>
                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                        <div class="input-group">
                            <input type="search" id="search" name="search" placeholder="<?php echo lang('search') ?>" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <div><?php echo lang('no_listing') ?></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sortno">
                                <td class="sortleft-m"></td>
                                <td class="sortleft">

                                    <form>
                                        <div>
                                            <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                            <button name="parent_up" value="<?php echo Stock::$parent_id ?>" class="btn btn-secondary btn-sm" title="" action="index.php" formmethod="get"><span class="glyphicon glyphicon-option-horizontal"></span></button>
                                        </div>
                                    </form>

                                </td>
                                <td class="options"><div class="context-one"><?php echo lang('no_listing') ?></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="modal-body">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 offset-0">
                    <form>
                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                        <div class="input-group">
                            <input type="search" id="search" name="search" placeholder="<?php echo lang('search') ?>" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <div><?php echo lang('no_listing') ?></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="sortleft-m"></td>
                                <td class="sortleft-m"></td>
                                <td class="options"><div class="context-one"><?php echo lang('no_listing') ?></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</div>