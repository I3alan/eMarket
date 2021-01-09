<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

// ПОДКЛЮЧАЕМ КОНТЕНТ
foreach (\eMarket\View::tlpc('content') as $path) {
    require_once (ROOT . $path);
}
?>

<!-- Модальное окно -->
<?php require_once('modal/recovery_password.php') ?>
<!-- КОНЕЦ Модальное окно -->

<!--Выводим уведомление об успешном действии-->
<div id="alert_block"><?php \eMarket\Messages::alert(); ?></div>
<h1><?php echo lang('login_to_account') ?></h1>

<div id="login" class="contentText">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" action="">
                        <legend><?php echo lang('regular_customer') ?></legend>
                        <div class="form-group has-error email">
                            <input class="form-control" type="email" placeholder="<?php echo lang('e_mail') ?>" id="email" name="email" required>
                        </div>
                        <div class="form-group has-error password">
                            <input class="form-control" type="password" minlength="7" maxlength="40" placeholder="<?php echo lang('password') ?>" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit"><?php echo lang('sign_in') ?></button>
                        </div>
                    </form>
                    <a class="btn btn-default" href="#forgot_password" data-toggle="modal"><?php echo lang('forgot_your_password') ?></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-body">
                    <legend><?php echo lang('new_customer') ?></legend>
                    <p><?php echo lang('login_description') ?></p>
                    <a href="/?route=register" class="btn btn-primary btn-block"><?php echo lang('continue') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>