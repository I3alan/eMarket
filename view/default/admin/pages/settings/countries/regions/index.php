<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

use \eMarket\Core\{
    Messages,
    Pages,
    Settings,
    Valid
};
use \eMarket\Admin\Regions;

require_once('modal/index.php')
?>

<div id="settings_countries_regions">
    <div class="card">
        <div class="card-header">
            <div id="alert_block"><?php Messages::alert(); ?></div>
            <h3 class="card-title">
                <span class="settings_back"><button type="button" onClick='location.href = "<?php echo $_SESSION['country_page'] ?>"' class="btn btn-primary btn-sm"><span class="bi-reply"></span></button></span><span class="settings_name"><?php echo Settings::titlePageGenerator() ?></span>
            </h3>
        </div>
        <div class="modal-body">

            <div id="ajax_data" class='hidden' data-jsondata='<?php echo Regions::$json_data ?>'></div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="align-middle">
                            <th colspan="2"><?php echo Pages::counterPage() ?></th>

                            <th>
                                <div class="gap-2 d-flex justify-content-end">

                                    <a href="#index" class="btn btn-primary btn-sm" data-bs-toggle="modal"><span class="bi-plus"></span></a>

                                    <form>
                                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                        <input hidden name="backstart" value="<?php echo Pages::$start ?>">
                                        <input hidden name="backfinish" value="<?php echo Pages::$finish ?>">
                                        <input hidden name="country_id" value="<?php echo Valid::inGET('country_id') ?>">
                                        <?php if (Pages::$start > 0) { ?>
                                            <button type="submit" class="btn btn-primary btn-sm" formmethod="get"><span class="bi-arrow-left-short"></span></button>
                                        <?php } else { ?>
                                            <a type="submit" class="btn btn-primary btn-sm disabled"><span class="bi-arrow-left-short"></span></a>
                                        <?php } ?>
                                    </form>

                                    <form>
                                        <input hidden name="route" value="<?php echo Valid::inGET('route') ?>">
                                        <input hidden name="start" value="<?php echo Pages::$start ?>">
                                        <input hidden name="finish" value="<?php echo Pages::$finish ?>">
                                        <input hidden name="country_id" value="<?php echo Valid::inGET('country_id') ?>">
                                        <?php if (Pages::$finish != Pages::$count) { ?>
                                            <button type="submit" class="btn btn-primary btn-sm" formmethod="get"><span class="bi-arrow-right-short"></span></button>
                                        <?php } else { ?>
                                            <a type="submit" class="btn btn-primary btn-sm disabled"><span class="bi-arrow-right-short"></span></a>
                                        <?php } ?>
                                    </form>

                                </div>
                            </th>
                        </tr>
                        <?php if (Pages::$count > 0) { ?>
                            <tr class="align-middle">
                                <th><?php echo lang('name_region') ?></th>
                                <th class="text-center"><?php echo lang('region_code') ?></th>
                                <th></th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php for (Pages::$start; Pages::$start < Pages::$finish; Pages::$start++, Pages::lineUpdate()) { ?>
                            <tr class="align-middle">
                                <td><?php echo Pages::$table['line']['name'] ?></td>
                                <td class="text-center"><?php echo Pages::$table['line']['region_code'] ?></td>
                                <td>
                                    <div class="gap-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#index" data-edit="<?php echo Pages::$table['line']['id'] ?>"><span class="bi-pencil-square"></span></button>
                                        <form id="form_delete<?php echo Pages::$table['line']['id'] ?>" name="form_delete" action="javascript:void(null);" enctype="multipart/form-data">
                                            <input hidden name="delete" value="<?php echo Pages::$table['line']['id'] ?>">
                                            <input hidden name="country_id" value="<?php echo Valid::inGET('country_id') ?>">
                                            <button type="button" name="delete_but" class="btn btn-primary btn-sm" onclick="Confirmation.del('<?php echo Pages::$table['line']['id'] ?>')"><span class="bi-trash"> </span></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>