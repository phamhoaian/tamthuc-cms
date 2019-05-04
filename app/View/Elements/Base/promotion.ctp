<?php if (!empty($promotions)) : ?>
<section class="promotion">
	<h2 class="page-title"><a href="<?php echo $this->Html->url('/khuyen-mai'); ?>"><?php echo __('Khuyến mãi'); ?></a></h2>
	<ul class="promotion-list">
		<?php foreach ($promotions as $promotion) : ?>
		<li class="item">
			<?php  
				if (empty($promotion['Promotion']['event_id'])) {
					$target_url = $this->Html->url('/khuyen-mai/'.$promotion['Promotion']['slug']);
				} else {
					$target_url = $this->Html->url('/su-kien/'.$promotion['Event']['slug']);
				}
			?>
			<a href="<?php echo $target_url; ?>" <?php if (!empty($promotion['Promotion']['event_id'])) echo 'target="_blank"' ?>>
				<h3 class="promotion-title"><?php echo h(json_decode($promotion['Promotion']['title'], TRUE)[Configure::read('Config.language_key')]); ?></h3>
				<?php echo $this->ImageLabel->image($promotion['Promotion']['top_pic']); ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="promotion-arrow">
		<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>
		<button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button>
	</div>
</section>
<?php endif; ?>