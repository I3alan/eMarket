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

<!-- Модальное окно "Редактировать" -->
<?php require_once('modal/index.php') ?>
<!-- КОНЕЦ Модальное окно "Редактировать" -->

<!--Выводим уведомление об успешном действии-->
<div id="alert_block"><?php \eMarket\Messages::alert(); ?></div>
<h1><?php echo lang('orders_book') ?></h1>

<div id="ajax_data" class='hidden' data-orders='<?php echo $orders_edit ?>'></div>

<div class="table-responsive">
    <table class="table table-hover">
	<thead>
	    <tr>
		<th colspan="4">
		    <?php if ($lines == TRUE) { ?>
			<?php echo lang('with') ?> <?php echo $start + 1 ?> <?php echo lang('to') ?> <?php echo $finish ?> ( <?php echo lang('of') ?> <?php echo $count_lines; ?> )
			<?php
		    } else {
			?>
			<?php echo lang('no_listing') ?>
		    <?php } ?>
		</th>

		<th>

                    <div class="flexbox">
			<form>
			    <input hidden name="route" value="<?php echo \eMarket\Valid::inGET('route') ?>">
			    <input hidden name="backstart" value="<?php echo $start ?>">
			    <input hidden name="backfinish" value="<?php echo $finish ?>">
			    <div class="b-left">
				<?php if ($start > 0) { ?>
				    <button type="submit" class="btn btn-primary btn-xs" formmethod="get"><span class="glyphicon glyphicon-chevron-left"></span></button>
				<?php } else { ?>
				    <a type="submit" class="btn btn-primary btn-xs disabled"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<?php } ?>
			    </div>
			</form>
			
			<form>
			    <input hidden name="route" value="<?php echo \eMarket\Valid::inGET('route') ?>">
			    <input hidden name="start" value="<?php echo $start ?>">
			    <input hidden name="finish" value="<?php echo $finish ?>">
			    <div>
				<?php if ($finish != $count_lines) { ?>
				    <button type="submit" class="btn btn-primary btn-xs" formmethod="get"><span class="glyphicon glyphicon-chevron-right"></span></button>
				<?php } else { ?>
				    <a type="submit" class="btn btn-primary btn-xs disabled"><span class="glyphicon glyphicon-chevron-right"></span></a>
				<?php } ?>
			    </div>
			</form>
                    <div>

		</th>
	    </tr>
	    <tr>
		<th><?php echo lang('orders_number') ?></th>
		<th class="text-center"><?php echo lang('orders_total') ?></th>
		<th class="text-center"><?php echo lang('orders_date_added') ?></th>
		<th class="text-center"><?php echo lang('orders_status') ?></th>
		<th></th>
	    </tr>
	</thead>
	<tbody>
	    <?php
	    if ($lines != FALSE) {
		for ($start; $start < $finish; $start++) {
		    ?>
		    <tr>
			<td><?php echo $lines[$start]['id'] ?></td>
			<td class="text-center"><?php echo json_decode($lines[$start]['order_total'], 1)['customer']['total_to_pay_format'] ?></td>
			<td class="text-center"><?php echo \eMarket\Settings::dateLocale($lines[$start]['date_purchased'], '%c') ?></td>
			<td class="text-center"><?php echo json_decode($lines[$start]['orders_status_history'], 1)[0]['customer']['status'] ?></td>

			<td>
			    <!--Вызов модального окна для редактирования-->
			    <div class="flexbox">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#index" data-edit="<?php echo $lines[$start]['id'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
			    </div>
			</td>
		    </tr>
		    <?php
		}
	    }
	    ?>

	</tbody>
    </table>
</div>
