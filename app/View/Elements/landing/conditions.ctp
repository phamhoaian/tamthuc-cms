<section class="conditions">
	<h3 class="condition-title"><?php echo __('Điều kiện'); ?>:</h3>
	<div class="condition-body">
		<?php echo json_decode($event['Event']['condition'], TRUE)['vi'] ?>
	</div>
</section>