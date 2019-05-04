<?php if (!empty($features)) : ?>
<section class="featured">
	<h2 class="page-title"><a href="<?php echo $this->Html->url('/net-dac-sac'); ?>"><?php echo __('Nét đặc sắc hương vị lẩu truyền thống Nhật'); ?></a></h2>
	<ul class="featured-list">
		<?php foreach ($features as $feature) : ?>
		<li class="featured-item">
			<div class="item-img">
				<?php echo $this->ImageLabel->image($feature['Feature']['top_pic']); ?>
			</div>
			<div class="item-info">
				<h3 class="item-title"><?php echo h(json_decode($feature['Feature']['title'], TRUE)[Configure::read('Config.language_key')]); ?></h3>
				<p>
					<?php 
						$content = json_decode($feature['Feature']['content'], TRUE)[Configure::read('Config.language_key')];
						echo strlen($content) > 50 ? mb_substr(strip_tags($content), 0, 50).'...' : strip_tags($content)
					?>
				</p>
				<?php echo $this->Html->link(__('Xem thêm'), '/net-dac-sac/'.$feature['Feature']['slug'], array('class' => 'view-more')); ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php endif; ?>