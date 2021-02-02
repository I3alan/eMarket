<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

use \eMarket\Core\{
    Products,
    Valid
};

if (Valid::inGET('search') OR !Valid::inGET('category_id')) {
    Products::$category_data['name'] = lang('breadcrumb_search');
}
?>

<script type="text/javascript" language="javascript">
    $('#breadcrumb').append('<li class="breadcrumb-item"><a href="/"><?php echo lang('breadcrumb_home') ?></a></li>');

<?php if (Valid::inGET('route') == 'products') { ?>
        function breadcrumb() {
            var breadcrumbid = $('div#data_breadcrumb').data('breadcrumbid');
            var breadcrumbname = $('div#data_breadcrumb').data('breadcrumbname');

            if (breadcrumbid.length > 0) {
                for (x = 0; x < breadcrumbname.length; x++) {
                    $('#breadcrumb').append('<li class="breadcrumb-item"><a href="/?route=listing&category_id=' + breadcrumbid[x] + '">' + breadcrumbname[x] + '</a></li>');
                }
            }
            $('#breadcrumb').append('<li class="breadcrumb-item"><a href="/?route=listing&category_id=<?php echo Valid::inGET('category_id') ?>"><?php echo Products::$category_data['name'] ?></a></li>');
            $('#breadcrumb').append('<li class="breadcrumb-item"><?php echo Products::$product_data['name'] ?></li>');
        }

        $(document).ready(function () {
            breadcrumb();
        });

<?php } elseif (Valid::inGET('route') == 'listing') {
    ?>
        function breadcrumb() {
            var breadcrumbid = $('div#data_breadcrumb').data('breadcrumbid');
            var breadcrumbname = $('div#data_breadcrumb').data('breadcrumbname');

            if (breadcrumbid.length > 0) {
                for (x = 0; x < breadcrumbname.length; x++) {
                    $('#breadcrumb').append('<li class="breadcrumb-item"><a href="/?route=listing&category_id=' + breadcrumbid[x] + '">' + breadcrumbname[x] + '</a></li>');
                }
            }
            $('#breadcrumb').append('<li class="breadcrumb-item"><?php echo Products::$category_data['name'] ?></li>');
        }

        $(document).ready(function () {
            breadcrumb();
        });
<?php } elseif (Valid::inGET('route') != '') { ?>
        function breadcrumb() {
            var breadcrumbid = $('div#data_breadcrumb').data('breadcrumbid');
            var breadcrumbname = $('div#data_breadcrumb').data('breadcrumbname');

            $('#breadcrumb').append('<li class="breadcrumb-item"><?php echo lang('title_' . basename(Valid::inGET('route')) . '_index') ?></li>');
        }

        $(document).ready(function () {
            breadcrumb();
        });
<?php } ?>
</script>