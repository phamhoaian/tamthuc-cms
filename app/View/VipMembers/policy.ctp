<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Thành viên VIP'); ?></h1>
	</section>
	<!-- <nav class="page-nav">
		<ul>
			<li class="nav-item<?php if ($active_menu == 'policy') echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/thanh-vien-vip'); ?>"><?php echo __('Chính sách thành viên VIP'); ?></a>
			</li>
			<li class="nav-item<?php if ($active_menu == 'request') echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/xem-diem-tich-luy'); ?>"><?php echo __('Xem điểm tích lũy'); ?></a>
			</li>
		</ul>
	</nav> -->
	<div class="page-body">
	<?php if (!empty(json_decode($policy['Policy']['content'], TRUE)[Configure::read('Config.language_key')])) : ?>
		<?php echo json_decode($policy['Policy']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	<?php else : ?>
		<div class="page-footer"><?php echo __('Không có chính sách nào!'); ?></div>
	<?php endif; ?>
	</div>
</div>