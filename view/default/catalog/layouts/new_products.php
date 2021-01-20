<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

use \eMarket\Core\{
    Ecb,
    Products,
};

Products::newProducts(8);

if (Products::$new_products == true) {
    ?>
    <div id="new_products" class="contentText">
        <h3><?php echo lang('new_products_name') ?></h3>
        <div class="row row-flex">
            <?php foreach (Products::$new_products as $value) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 grid-group-item">
                    <div class="productHolder">
                        <?php echo Products::stikers($value, 'label-danger', 'label-success') ?>
                        <a href="/?route=products&category_id=<?php echo $value['parent_id'] ?>&id=<?php echo $value['id'] ?>"><img src="/uploads/images/products/resize_1/<?php echo $value['logo_general'] ?>" alt="<?php echo $value['name']; ?>" class="img-responsive center-block"></a>
                        <h5 class="text-center item-heading"><a href="/?route=products&category_id=<?php echo $value['parent_id'] ?>&id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h5>
                        <div class="text-center item-price"><?php echo Ecb::priceInterface($value, 2) ?></div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php }