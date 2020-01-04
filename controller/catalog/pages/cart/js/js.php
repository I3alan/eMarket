<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-= 
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

\eMarket\Ajax::сart('');
?>

<!-- Загрузка данных в модальное окно Корзина -->
<script type = "text/javascript">
    $('#cart').on('show.bs.modal', function (event) {

        // Устанавливаем методы доставки
        jQuery.post('<?php echo \eMarket\Valid::inSERVER('REQUEST_URI') ?>',
                {shipping_method_json: $(':selected', '#address').data('regions')},
                AjaxSuccess);
        // Обновление страницы
        function AjaxSuccess(data) {
            var shipping_method = $.parseJSON(data);
            $("#shipping_method").empty();

            if (shipping_method.length < 1) {
                    $("#shipping_method").append($('<option value="no"><?php echo lang('cart_shipping_is_not_available') ?></option>'));
                } else {
                    for (x = 0; x < shipping_method.length; x++) {
                        $("#shipping_method").append($('<option value="' + shipping_method[x][0] + '">' + shipping_method[x][1] + '</option>'));
                    }
                }
        }
        // Если выбрали адрес, то загружаем методы доставки
        $('#address').change(function (event) {
            jQuery.post('<?php echo \eMarket\Valid::inSERVER('REQUEST_URI') ?>',
                    {shipping_method_json: $(':selected', this).data('regions')},
                    AjaxSuccess);
            // Обновление страницы
            function AjaxSuccess(data) {
                var shipping_method = $.parseJSON(data);
                $("#shipping_method").empty();

                if (shipping_method.length < 1) {
                    $("#shipping_method").append($('<option value="no"><?php echo lang('cart_shipping_is_not_available') ?></option>'));
                } else {
                    for (x = 0; x < shipping_method.length; x++) {
                        $("#shipping_method").append($('<option value="' + shipping_method[x][0] + '">' + shipping_method[x][1] + '</option>'));
                    }
                }
            }
        });
    });
</script>

<script type="text/javascript">
    function pcsProduct(val, id) {
        var a = $('#number_' + id).val();

        if (val === 'minus' && a > 1) {
            $('#number_' + id).val(+a - 1);
        }
        if (val === 'plus') {
            $('#number_' + id).val(+a + 1);
        }
    }
</script>