<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Nét đặc sắc hương vị lẩu truyền thống Nhật'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($feature_list as $row) : ?>
			<li class="nav-item<?php if ($row['Feature']['slug'] == $slug) echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/net-dac-sac/'.$row['Feature']['slug']); ?>"><?php echo h(json_decode($row['Feature']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<div class="page-body">
		<?php echo json_decode($feature['Feature']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
		<?php if ($how_to_enjoy) : ?>
		<div class="step-by-step">
			<h3 class="step-title">
				<?php echo $this->Html->image('cach-thuong-thuc-'.$feature['Feature']['slug'].'.png'); ?>
				<?php echo __('Cách thưởng thức %s', h(json_decode($feature['Feature']['title'], TRUE)[Configure::read('Config.language_key')])); ?>
			</h3>
			<ul class="steps">
				<?php foreach ($how_to_enjoy as $enjoy) : ?>
				<li class="step-item">
					<?php echo $this->ImageLabel->image($enjoy['Optional']['top_pic'], array('class' => 'step-img')); ?>
					<div class="step-content"><?php echo h(json_decode($enjoy['Optional']['content'], TRUE)[Configure::read('Config.language_key')]) ?></div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php if ($sauce) : ?>
		<div class="step-by-step <?php echo $feature['Feature']['cols'] == ONE_COLUMN ? 'one-column' : 'two-columns' ?>">
			<h3 class="step-title">
				<?php echo $this->Html->image('nuoc-cham-'.$feature['Feature']['slug'].'.png'); ?>
				<?php echo __('Sự hòa quyện hoàn hảo của nước chấm'); ?>
			</h3>
			<ul class="steps">
				<?php foreach ($sauce as $sau) : ?>
				<li class="step-item">
					<?php echo $this->ImageLabel->image($sau['Optional']['top_pic'], array('class' => 'step-img')); ?>
					<div class="step-content"><?php echo h(json_decode($sau['Optional']['content'], TRUE)[Configure::read('Config.language_key')]) ?></div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<div class="page-footer"><?php echo __('Cuối cùng hãy thưởng thức %s thật ngon miệng !', h(json_decode($feature['Feature']['title'], TRUE)[Configure::read('Config.language_key')])); ?></div>
</div>