<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

// ПОДКЛЮЧАЕМ КОНТЕНТ
foreach ($VIEW->layoutRouting('content') as $path) {
    require_once (ROOT . $path);
}

?>

<h1>Shopping Cart</h1>
<div id="checkout" class="contentText">
    <form enctype="multipart/form-data" method="post" action="#">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-center"><a href="/"><img class="img-thumbnail" src="2product50x59.jpg"></a></td>
                        <td class="text-left"><a href="/">Название товара</a></td>
                        <td class="text-left">
                            <div class="input-group btn-block">
                                <input type="text" class="form-control quantity" size="1" value="1" name="quantity">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-refresh"></span></button>
                                    <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-trash"></span></button>
                                </span>
                            </div>
                        </td>
                        <td class="text-right">254.00 руб.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-right"><strong>Total:</strong></td>
                        <td class="text-right">254.00 руб.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="input-group-btn button">
        <div class="pull-left"><a class="btn btn-primary" href="/">Continue Shopping</a></div>
        <div class="pull-right"><a class="btn btn-primary" href="/">Checkout</a></div>
    </div>
</div>