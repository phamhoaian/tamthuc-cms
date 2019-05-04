<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Tuyển dụng'); ?></h1>
	</section>
	<div class="page-body">
	<?php if (!empty(json_decode($recruitment['Recruitment']['content'], TRUE)[Configure::read('Config.language_key')])) : ?>
		<?php echo json_decode($recruitment['Recruitment']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	<?php else : ?>
		<div class="page-footer"><?php echo __('Không có tin tuyển dụng nào!'); ?></div>
	<?php endif; ?>
	</div>
</div>