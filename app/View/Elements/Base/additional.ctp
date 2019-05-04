<section class="additional">
	<div class="additional-item">
		<a href="<?php echo $this->Html->url('/tin-tuc'); ?>">
			<?php echo $this->Html->image('tin-tuc.svg', array('alt' => __('Tin tức'))); ?>
			<h3><?php echo __('Tin tức'); ?></h3>
		</a>
	</div>
	<div class="additional-item vip-member">
		<a href="<?php echo $this->Html->url('/thanh-vien-vip'); ?>">
			<?php echo $this->Html->image('thanh-vien.svg', array('alt' => __('Thành viên'))); ?>
			<h3><?php echo __('Thành viên'); ?></h3>
		</a>
	</div>
	<div class="additional-item">
		<a href="<?php echo $this->Html->url('/tuyen-dung'); ?>">
			<?php echo $this->Html->image('tuyen-dung.svg', array('alt' => __('Tuyển dụng'))); ?>
			<h3><?php echo __('Tuyển dụng'); ?></h3>
		</a>
	</div>
</section>