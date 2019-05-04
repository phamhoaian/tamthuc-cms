<section class="main-content">
	<?php if (count($agencies) > 0) : ?>
	<ul class="agency">
		<?php foreach ($agencies as $agency) : ?>
		<li class="agency-item">
			<h3 class="agency-title"><?php echo json_decode($agency['Agency']['title'], TRUE)['vi']; ?></h3>
			<div class="agency-info"><?php echo json_decode($agency['Agency']['content'], TRUE)['vi']; ?></div>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<ul class="mo-intro">
		<li>Mo Mo Paradise có mặt tại hơn 9 quốc gia trên thế giới với hơn 100 nhà hàng.</li>
		<li>Nguyên liệu lẩu truyền thống nhập khẩu 100% từ Nhật Bản.</li>
	</ul>
	<ul class="mo-img">
		<li><?php echo $this->Html->image('restaurant-1.jpg'); ?></li>
		<li><?php echo $this->Html->image('restaurant-2.jpg'); ?></li>
	</ul>
	<div class="logo">
		<a href="<?php echo $this->Html->url('/'); ?>">
			<?php echo $this->Html->image('logo.svg'); ?>
		</a>
	</div>
	<ul class="country">
		<li>Japan</li>
		<li>Taiwan</li>
		<li>China</li>
		<li>Thailand</li>
		<li>Vietnam</li>
		<li>U.S.A</li>
		<li>Cambodia</li>
		<li>Indonesia</li>
	</ul>
</section>