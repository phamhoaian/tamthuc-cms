<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Khuyến mãi'); ?></h1>
	</section>
	<div class="page-body">
		<?php echo json_decode($promotion['Promotion']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	</div>
</div>