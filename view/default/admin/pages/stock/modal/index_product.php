<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

use \eMarket\Core\{
    Lang,
    Settings
};
use \eMarket\Admin\Stock;
?>

<div id="index_product" class="products modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo Settings::titlePageGenerator() ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="form_add_product" class="was-validated" name="form_add_product" action="javascript:void(null);" onsubmit="Ajax.callAdd('form_add_product')">
                <div class="modal-body">
                    <input type="hidden" name="parent_id" value="<?php echo Stock::$parent_id ?>" />
                    <input type="hidden" id="add_product" name="add_product" value="" />
                    <input type="hidden" id="edit_product" name="edit_product" value="" />
                    <input id="general_image_add_product" type="hidden" name="general_image_add_product" value="">
                    <input id="delete_image_product" type="hidden" name="delete_image_product" value="" />
                    <input id="general_image_edit_product" type="hidden" name="general_image_edit_product" value="" />
                    <input id="general_image_edit_new_product" type="hidden" name="general_image_edit_new_product" value="" />
                    <input id="selected_attributes" type="hidden" name="selected_attributes" value="" />

                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#panel_add_product_1"><?php echo lang('stock_product_description') ?></a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#panel_add_product_2"><?php echo lang('stock_product_basic') ?></a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#panel_add_product_3"><?php echo lang('stock_product_additional') ?></a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#panel_add_product_4"><?php echo lang('stock_product_specification') ?></a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#panel_add_product_5"><?php echo lang('stock_product_images') ?></a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="panel_add_product_1" class="tab-pane fade show in active">

                            <?php require_once(ROOT . '/view/' . Settings::template() . '/layouts/lang_tabs_add_product.php') ?>

                            <div class="tab-content">
                                <div id="product_<?php echo lang('#lang_all')[0] ?>" class="tab-pane fade show in active">
                                    <div class="mb-3">
                                        <div><small class="form-text text-muted"><?php echo lang('stock_product_name') ?></small></div>
                                        <div class="input-group">
                                            <span class="input-group-text"><span class="bi-file-text"></span></span>
                                            <input class="input-sm form-control" placeholder="<?php echo lang('name') ?>" type="text" name="name_product_stock_0" id="name_product_stock_0" required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div><small class="form-text text-muted"><?php echo lang('stock_product_description') ?></small></div>
                                        <textarea rows="3" class="input-sm form-control summernote_add" name="description_product_stock_0" id="description_product_stock_0" /></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div><small class="form-text text-muted"><?php echo lang('stock_product_keywords') ?></small></div>
                                            <div class="input-group">
                                                <span class="input-group-text"><span class="bi-file-text"></span></span>
                                                <input class="input-sm form-control" placeholder="Keywords" type="text" name="keyword_product_stock_0" id="keyword_product_stock_0" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div><small class="form-text text-muted"><?php echo lang('stock_product_tags') ?></small></div>
                                            <div class="input-group">
                                                <span class="input-group-text"><span class="bi-file-text"></span></span>
                                                <input class="input-sm form-control" placeholder="Tags" type="text" name="tags_product_stock_0" id="tags_product_stock_0" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (Lang::$count > 1) {
                                    for ($x = 1; $x < Lang::$count; $x++) {
                                        ?>

                                        <div id="product_<?php echo lang('#lang_all')[$x] ?>" class="tab-pane fade">
                                            <div class="mb-3">
                                                <div><small class="form-text text-muted"><?php echo lang('stock_product_name') ?></small></div>
                                                <div class="input-group">
                                                    <span class="input-group-text"><span class="bi-file-text"></span></span>
                                                    <input class="input-sm form-control" placeholder="<?php echo lang('name') ?>" type="text" name="name_product_stock_<?php echo $x ?>" id="name_product_stock_<?php echo $x ?>" required />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div><small class="form-text text-muted"><?php echo lang('stock_product_description') ?></small></div>
                                                <textarea rows="3" class="input-sm form-control summernote_add" name="description_product_stock_<?php echo $x ?>" id="description_product_stock_<?php echo $x ?>" /></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_keywords') ?></small></div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><span class="bi-file-text"></span></span>
                                                        <input class="input-sm form-control" placeholder="Keywords" type="text" name="keyword_product_stock_<?php echo $x ?>" id="keyword_product_stock_<?php echo $x ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_tags') ?></small></div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><span class="bi-file-text"></span></span>
                                                        <input class="input-sm form-control" placeholder="Tags" type="text" name="tags_product_stock_<?php echo $x ?>" id="tags_product_stock_<?php echo $x ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <div id="panel_add_product_2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_price') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="0.00" type="text" name="price_product_stock" id="price_product_stock" required />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_currency') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-cash"></span></span>
                                        <select name="currency_product_stock" id="currency_product_stock" class="form-select">
                                            <?php foreach (Stock::$currencies_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo Settings::viewSelect($val, 'default_value') ?>><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_quantity_in_stock') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="1" type="text" name="quantity_product_stock" id="quantity_product_stock" required />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_quantity_unit') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-flag"></span></span>
                                        <select name="unit_product_stock" id="unit_product_stock" class="form-select">
                                            <?php foreach (Stock::$units_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo Settings::viewSelect($val, 'default_unit') ?>><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_model') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-file-text"></span></span>
                                        <input class="input-sm form-control" placeholder="ABC123" type="text" name="model_product_stock" id="model_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_manufacturer') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-align-bottom"></span></span>
                                        <select name="manufacturers_product_stock" id="manufacturers_product_stock" class="form-select">
                                            <?php foreach (Stock::$manufacturers_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_receipt_date') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-calendar"></span></span>
                                        <input class="input-sm form-control" placeholder="<?php echo lang('stock_product_receipt_date') ?>" type="text" name="date_available_product_stock" id="date_available_product_stock" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_tax') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-briefcase"></span></span>
                                        <select name="tax_product_stock" id="tax_product_stock" class="form-select">
                                            <?php foreach (Stock::$taxes_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div id="panel_add_product_3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_vendor_code_value') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-file-text"></span></span>
                                        <input class="input-sm form-control" placeholder="ABC123" type="text" name="vendor_code_value_product_stock" id="vendor_code_value_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_vendor_code') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-tag"></span></span>
                                        <select name="vendor_codes_product_stock" id="vendor_codes_product_stock" class="form-select">
                                            <?php foreach (Stock::$vendor_codes_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo Settings::viewSelect($val, 'default_vendor_code') ?>><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_weight_value') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="0.00" type="text" name="weight_value_product_stock" id="weight_value_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_weight') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-inbox"></span></span>
                                        <select name="weight_product_stock" id="weight_product_stock" class="form-select">
                                            <?php foreach (Stock::$weight_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo Settings::viewSelect($val, 'default_weight') ?>><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_minimum_order_quantity') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="1" type="text" name="min_quantity_product_stock" id="min_quantity_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_length_unit') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-rulers"></span></span>
                                        <select name="length_product_stock" id="length_product_stock" class="form-select">
                                            <?php foreach (Stock::$length_all as $val) { ?>
                                                <option value="<?php echo $val['id'] ?>" <?php echo Settings::viewSelect($val, 'default_length') ?>><?php echo $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_length_value') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="0.00" type="text" name="value_length_product_stock" id="value_length_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_width_value') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="0.00" type="text" name="value_width_product_stock" id="value_width_product_stock" />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div><small class="form-text text-muted"><?php echo lang('stock_product_height_value') ?></small></div>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="bi-sort-numeric-down"></span></span>
                                        <input class="input-sm form-control" placeholder="0.00" type="text" name="value_height_product_stock" id="value_height_product_stock" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel_add_product_4" class="tab-pane fade">
                            <div class="product-attribute" id="accordion"></div>
                        </div>

                        <div id="panel_add_product_5" class="tab-pane fade">

                            <div id="alert_messages_product"></div>

                            <!-- jQuery-File-Upload -->
                            <div class="mb-3">
                                <span class="btn btn-primary btn-sm fileinput-button">
                                    <span class="bi-image"></span><span> <?php echo lang('button_add_image') ?></span>
                                    <input class="input-sm form-control" id="fileupload-product" type="file" name="files[]" accept="image/jpeg,image/png,image/gif" multiple>
                                </span>
                                <?php echo lang('max') ?>: <?php echo get_cfg_var('upload_max_filesize'); ?>
                                <br>
                                <br>
                                <div><small class="form-text text-muted"><?php echo lang('stock_product_effects_for_image_processing') ?></small></div>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="bi-circle-half"></span></span>
                                    <select name="effect-product" id="effect-product" class="form-select">
                                        <option value="effect-off" selected><?php echo lang('stock_product_no_effects') ?></option>
                                        <option value="effect-sepia"><?php echo lang('stock_product_sepia_effect') ?></option>
                                        <option value="effect-black-white"><?php echo lang('stock_product_black_and_white_effect') ?></option>
                                        <option value="effect-blur-1"><?php echo lang('stock_product_blur1_effect') ?></option>
                                        <option value="effect-blur-2"><?php echo lang('stock_product_blur2_effect') ?></option>
                                    </select>
                                </div>
                                <br>
                                <div id="progress_product" class="progress">
                                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated"></div>
                                </div>
                                <div id="logo-product" class="text-center"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span class="bi-x-circle"></span> <?php echo lang('cancel') ?></button>
                    <button type="submit" class="btn btn-primary btn-sm"><span class="bi-check-circle"></span> <?php echo lang('save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>