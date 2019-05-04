<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Khuyến mãi'); ?></h1>
	</section>
	<div class="page-body">
	<?php if ($promotion_list) : ?>
		<ul class="promotion-list">
			<?php foreach ($promotion_list as $promotion) : ?>
			<?php  
				if (empty($promotion['Promotion']['event_id'])) {
					$target_url = $this->Html->url('/khuyen-mai/'.$promotion['Promotion']['slug']);
				} else {
					$target_url = $this->Html->url('/su-kien/'.$promotion['Event']['slug']);
				}
			?>
			<li class="promotion-item">
				<a href="<?php echo $target_url; ?>" <?php if (!empty($promotion['Promotion']['event_id'])) echo 'target="_blank"' ?>>
					<?php echo $this->ImageLabel->image($promotion['Promotion']['top_pic'], array('class' => 'promotion-img')); ?>
				</a>
				<div class="promotion-info">
					<a href="<?php echo $target_url; ?>" class="promotion-title" <?php if (!empty($promotion['Promotion']['event_id'])) echo 'target="_blank"' ?>><?php echo h(json_decode($promotion['Promotion']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
					<a href="<?php echo $target_url; ?>" class="view-more" <?php if (!empty($promotion['Promotion']['event_id'])) echo 'target="_blank"' ?>><?php echo __('Xem chi tiết'); ?></a>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php echo $this->element('admin/pagination') ?>
	<?php else : ?>
		<div class="page-footer"><?php echo __('Không có khuyến mãi nào!'); ?></div>
	<?php endif; ?>
	</div>
</div>