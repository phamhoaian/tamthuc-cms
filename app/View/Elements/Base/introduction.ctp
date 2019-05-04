<?php if (!empty($introductions)) : ?>
<section class="introduction">
	<h2 class="page-title"><a href="<?php echo $this->Html->url('/gioi-thieu'); ?>"><?php echo __('Giới thiệu'); ?></a></h2>
	<div class="introduction-list">
		<?php foreach ($introductions as $key => $introduction) : ?>
		<?php if (in_array($key, array(0,1))) : ?>
		<div class="col-4">
		<?php endif; ?>
		<?php if ($key === 3) : ?>
		<div class="col-2">
		<?php endif; ?>
			<div class="item" data-intro-id="<?php echo $introduction['Introduction']['id']; ?>">
				<?php echo $this->ImageLabel->image($introduction['Introduction']['top_pic']); ?>
			</div>
		<?php if (in_array($key, array(0,2,3))) : ?>
		</div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="introduction-body">
		<?php foreach ($introductions as $key => $introduction) : ?>
		<div id="intro_<?php echo $introduction['Introduction']['id']; ?>" class="introduction-content<?php if ($key === 0) echo ' active'; ?>">
			<h3 class="introduction-title"><?php echo h(json_decode($introduction['Introduction']['title'], TRUE)[Configure::read('Config.language_key')]); ?></h3>
			<p>
				<?php 
					$content = json_decode($introduction['Introduction']['content'], TRUE)[Configure::read('Config.language_key')];
					echo strlen($content) > 200 ? mb_substr(strip_tags($content), 0, 200).'...' : strip_tags($content)
				?>
			</p>
			<?php echo $this->Html->link(__('Xem thêm'), '/gioi-thieu/'.$introduction['Introduction']['slug'], array('class' => 'view-more')); ?>
		</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>